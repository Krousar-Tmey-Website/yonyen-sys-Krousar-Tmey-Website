<?php

namespace App\Support;

class HtmlSanitizer
{
    public static function clean(?string $html): ?string
    {
        if ($html === null) {
            return null;
        }

        $clean = trim(app('purifier')->clean($html, 'rich_text'));

        return $clean === '' ? null : $clean;
    }
}
