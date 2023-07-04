<?php

namespace App\Infrastructure;

use App\Domain\ArchiveAggregate;
use App\Domain\Context;

class TaskListFormatter
{
    public static function display(ArchiveAggregate $archive): void
    {
        echo PHP_EOL;
        if ($archive->isEmpty()) {
            echo 'No tasks' . PHP_EOL;
            return;
        }
        self::displayContexts($archive->getContextCollection());
    }

    private static function displayContexts($contexts): void
    {
        foreach ($contexts as $context) {
            self::displayContext($context);
        }
    }

    private static function displayContext(Context $context): void
    {
        echo $context->name;
    }

}