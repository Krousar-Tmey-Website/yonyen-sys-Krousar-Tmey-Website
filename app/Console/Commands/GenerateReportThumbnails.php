<?php

namespace App\Console\Commands;

use App\Models\AnnualReport;
use App\Services\ReportThumbnailGenerator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateReportThumbnails extends Command
{
    protected $signature = 'reports:generate-thumbnails
        {--force : Regenerate thumbnails even if they already exist}';

    protected $description = 'Generate thumbnail images from first page of annual report PDFs';

    public function handle(ReportThumbnailGenerator $thumbnails): int
    {
        if (! $thumbnails->isAvailable()) {
            $this->error('The imagick PHP extension is not installed.');
            $this->line('');
            $this->line('To generate PDF thumbnails, you need:');
            $this->line('  1. Install Ghostscript (gs) on your server');
            $this->line('  2. Install the PHP imagick extension (php_imagick.dll / imagick.so)');
            $this->line('');
            $this->line('Without these, the public visitor page will show styled PDF cards');
            $this->line('with a document icon as a fallback.');
            return Command::FAILURE;
        }

        $query = AnnualReport::query();

        if (! $this->option('force')) {
            $query->whereNull('thumbnail_path');
        }

        $reports = $query->get();
        $total = $reports->count();
        $generated = 0;
        $skipped = 0;

        if ($total === 0) {
            $this->info('All annual reports already have thumbnails. Use --force to regenerate.');
            return Command::SUCCESS;
        }

        $this->info("Found {$total} report(s) to process...");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($reports as $report) {
            if (! $report->has_pdf_file) {
                $skipped++;
                $bar->advance();
                continue;
            }

            try {
                $thumbnails->generate($report);
                $generated++;
            } catch (\Exception $e) {
                $this->warn("Failed for report #{$report->id} ({$report->title}): " . $e->getMessage());
                Log::warning("Thumbnail generation failed for report #{$report->id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Done! Generated: {$generated}, Skipped (no PDF): {$skipped}");

        return Command::SUCCESS;
    }
}
