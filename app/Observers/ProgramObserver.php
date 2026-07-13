<?php

namespace App\Observers;

use App\Models\Program;
use App\Services\ActivityLogger;

class ProgramObserver
{
    public function created(Program $program): void
    {
        ActivityLogger::log(
            'created',
            $program,
            "Program {$program->title} was created.",
            $program->toArray()
        );
    }

    public function updated(Program $program): void
    {
        ActivityLogger::log(
            'updated',
            $program,
            "Program {$program->title} was updated.",
            [
                'old' => $program->getOriginal(),
                'new' => $program->getChanges(),
            ]
        );
    }

    public function deleted(Program $program): void
    {
        ActivityLogger::log(
            'deleted',
            $program,
            "Program {$program->title} was deleted.",
            $program->toArray()
        );
    }
}
