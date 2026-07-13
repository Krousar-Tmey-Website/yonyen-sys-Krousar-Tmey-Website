<?php

namespace App\Observers;

use App\Models\Child;
use App\Services\ActivityLogger;

class ChildObserver
{
    public function created(Child $child): void
    {
        ActivityLogger::log(
            'created',
            $child,
            "Child {$child->FirstName} {$child->LastName} was created.",
            $child->toArray()
        );
    }

    public function updated(Child $child): void
    {
        ActivityLogger::log(
            'updated',
            $child,
            "Child {$child->FirstName} {$child->LastName} was updated.",
            [
                'old' => $child->getOriginal(),
                'new' => $child->getChanges(),
            ]
        );
    }

    public function deleted(Child $child): void
    {
        ActivityLogger::log(
            'deleted',
            $child,
            "Child {$child->FirstName} {$child->LastName} was deleted.",
            $child->toArray()
        );
    }
}
