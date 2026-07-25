<?php

namespace App\Models\Concerns;

/**
 * Runs every field listed in $purifiedHtml through HTMLPurifier (see config/purifier.php)
 * before it's saved, so CKEditor output (or anything else posted into these columns) can
 * never carry <script>, event-handler attributes, or javascript: links into the database —
 * those fields are later rendered raw ({!! !!}) on public pages.
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasPurifiedHtml
{
    protected static function bootHasPurifiedHtml(): void
    {
        static::saving(function ($model) {
            foreach ($model->purifiedHtml ?? [] as $field) {
                if (isset($model->attributes[$field]) && $model->attributes[$field] !== null) {
                    $model->attributes[$field] = clean($model->attributes[$field]);
                }
            }
        });
    }
}
