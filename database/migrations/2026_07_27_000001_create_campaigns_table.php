<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Campaigns feature.
 *
 * A `campaigns` table already exists on some environments — it was created outside
 * the migration history by an earlier, abandoned fundraising-goal prototype and is
 * referenced by no model, controller, route or view. Rather than drop it (and the
 * rows it holds), this migration adapts it in place: new columns are added, the
 * legacy `youtube_url`/`pdf` values are folded into `video`/`file`, and the legacy
 * goal/date columns are made optional so they no longer block inserts.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('campaigns')) {
            $this->createFresh();

            return;
        }

        $this->addMissingColumns();
        $this->foldLegacyColumns();
        $this->relaxLegacyColumns();
        $this->backfill();
    }

    private function createFresh(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('year', 20)->nullable()->index();
            $table->string('title');
            $table->string('title_fr')->nullable();
            // CKEditor output with inline styles can exceed TEXT's 65 KB — use LONGTEXT.
            $table->longText('description')->nullable();
            $table->longText('description_fr')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('file')->nullable();
            $table->string('file_original_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    private function addMissingColumns(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            if (! Schema::hasColumn('campaigns', 'year')) {
                $table->string('year', 20)->nullable()->after('slug')->index();
            }
            if (! Schema::hasColumn('campaigns', 'title_fr')) {
                $table->string('title_fr')->nullable()->after('title');
            }
            if (! Schema::hasColumn('campaigns', 'description_fr')) {
                $table->longText('description_fr')->nullable()->after('description');
            }
            if (! Schema::hasColumn('campaigns', 'file')) {
                $table->string('file')->nullable()->after('video');
            }
            if (! Schema::hasColumn('campaigns', 'file_original_name')) {
                $table->string('file_original_name')->nullable()->after('file');
            }
        });
    }

    /** Copy the prototype's youtube_url/pdf values into the columns this feature uses. */
    private function foldLegacyColumns(): void
    {
        if (Schema::hasColumn('campaigns', 'youtube_url')) {
            DB::table('campaigns')
                ->whereNull('video')
                ->whereNotNull('youtube_url')
                ->update(['video' => DB::raw('youtube_url')]);

            Schema::table('campaigns', fn (Blueprint $t) => $t->dropColumn('youtube_url'));
        }

        if (Schema::hasColumn('campaigns', 'pdf')) {
            DB::table('campaigns')
                ->whereNull('file')
                ->whereNotNull('pdf')
                ->update(['file' => DB::raw('pdf')]);

            Schema::table('campaigns', fn (Blueprint $t) => $t->dropColumn('pdf'));
        }
    }

    /**
     * The prototype left goal/collected as NOT NULL with no default, which would reject
     * every insert from the new form. Give them defaults instead of dropping the data.
     */
    private function relaxLegacyColumns(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            foreach (['goal_amount', 'collected_amount'] as $column) {
                if (Schema::hasColumn('campaigns', $column)) {
                    $table->decimal($column, 12, 2)->default(0)->change();
                }
            }

            foreach (['start_date', 'end_date'] as $column) {
                if (Schema::hasColumn('campaigns', $column)) {
                    $table->date($column)->nullable()->change();
                }
            }

            $table->boolean('is_active')->default(true)->change();
            $table->unsignedInteger('sort_order')->default(0)->change();
            $table->longText('description')->nullable()->change();
        });
    }

    /** Existing rows carry no slug or year — derive both so they render on the public page. */
    private function backfill(): void
    {
        $taken = [];

        foreach (DB::table('campaigns')->select('id', 'title', 'slug', 'year', 'created_at')->get() as $row) {
            $update = [];

            if (empty($row->slug)) {
                $base = Str::slug($row->title) ?: 'campaign';
                $slug = $base;
                $n = 1;

                while (in_array($slug, $taken, true) || DB::table('campaigns')->where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $n++;
                }

                $taken[] = $slug;
                $update['slug'] = $slug;
            }

            if (empty($row->year)) {
                $source = (Schema::hasColumn('campaigns', 'start_date')
                        ? DB::table('campaigns')->where('id', $row->id)->value('start_date')
                        : null)
                    ?: $row->created_at;

                $update['year'] = $source ? date('Y', strtotime((string) $source)) : date('Y');
            }

            if ($update) {
                DB::table('campaigns')->where('id', $row->id)->update($update);
            }
        }
    }

    public function down(): void
    {
        // The table predates this migration on upgraded environments, so only the
        // columns it introduced are removed — the table itself is left in place.
        Schema::table('campaigns', function (Blueprint $table) {
            foreach (['year', 'title_fr', 'description_fr', 'file', 'file_original_name'] as $column) {
                if (Schema::hasColumn('campaigns', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
