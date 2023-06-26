<?php

declare(strict_types=1);

namespace App\Domain;

class Context
{
    public function __construct(public string $name, public TaskCollection $taskCollection = new TaskCollection())
    {
    }

    public function addTask(Task $task): void
    {
        $this->taskCollection->addItem($task);
    }
}