<?php

namespace App\Observers;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Model;

class ModelActivityObserver
{
    public function created(Model $model): void
    {
        if ($this->shouldSkip()) {
            return;
        }

        ActivityLogger::log(
            'created',
            $model,
            $this->label($model, 'created'),
            $model->toArray()
        );
    }

    public function updated(Model $model): void
    {
        if ($this->shouldSkip()) {
            return;
        }

        ActivityLogger::log(
            'updated',
            $model,
            $this->label($model, 'updated'),
            [
                'old' => $model->getOriginal(),
                'new' => $model->getChanges(),
            ]
        );
    }

    public function deleted(Model $model): void
    {
        if ($this->shouldSkip()) {
            return;
        }

        ActivityLogger::log(
            'deleted',
            $model,
            $this->label($model, 'deleted'),
            $model->toArray()
        );
    }

    protected function shouldSkip(): bool
    {
        // Don't log while running seeders/commands (avoids noise and recursion).
        return app()->runningInConsole();
    }

    protected function label(Model $model, string $action): string
    {
        $name = class_basename($model);

        return ucfirst($action) . ' ' . $name . ' #' . $model->getKey();
    }
}
