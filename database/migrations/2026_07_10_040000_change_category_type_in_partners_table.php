<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * No-op. This migration originally converted partners.category_id from an
     * integer FK back into a free-text varchar column, but Partner/PartnerCategory
     * (belongsTo/hasMany on category_id), the admin partner form requests
     * (category_id => exists:partner_categories,id), the admin partner filter,
     * and the public Who We Are page all depend on category_id staying an
     * integer FK to partner_categories.id. Converting it would have silently
     * broken those relationships, so this migration is kept only as a marker
     * that intentionally does nothing.
     */
    public function up(): void
    {
        //
    }

    public function down(): void
    {
        //
    }
};
