<?php

namespace App\Services;

use App\Models\AnnualReport;
use Illuminate\Support\Facades\Storage;

class ReportThumbnailGenerator
{
    public function isAvailable(): bool
    {
        return extension_loaded('imagick');
    }

    /**
     * Create and persist a first-page cover image for an annual report.
     *
     * @throws \RuntimeException when the server cannot produce a thumbnail
     */
    public function generate(AnnualReport $report): string
    {
        if (! $this->isAvailable()) {
            throw new \RuntimeException('The imagick PHP extension is not installed.');
        }

        if (! $report->has_pdf_file) {
            throw new \RuntimeException('The report PDF is not available on the public disk.');
        }

        $disk = Storage::disk('public');
        $thumbnailDir = 'reports/thumbnails';
        $thumbnailPath = $thumbnailDir . '/' . pathinfo($report->file_path, PATHINFO_FILENAME) . '.jpg';

        if (! $disk->exists($thumbnailDir)) {
            $disk->makeDirectory($thumbnailDir);
        }

        (new \Spatie\PdfToImage\Pdf($disk->path($report->file_path)))
            ->setPage(1)
            ->setWidth(400)
            ->quality(80)
            ->saveImage($disk->path($thumbnailPath));

        $report->updateQuietly(['thumbnail_path' => $thumbnailPath]);

        return $thumbnailPath;
    }
}
