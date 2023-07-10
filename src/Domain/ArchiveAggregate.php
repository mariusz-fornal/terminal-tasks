<?php

declare(strict_types=1);

namespace App\Domain;

use JsonSerializable;

class ArchiveAggregate implements JsonSerializable
{
    public function __construct(private ContextCollection $contexts = new ContextCollection()) {}

    public static function import(array $archiveData): ArchiveAggregate
    {
        $archive = new ArchiveAggregate();
        foreach ($archiveData as $archiveContext) {
            $context = $archive->addContext(new Context($archiveContext->name));
            foreach ($archiveContext->taskCollection as $archiveTask) {
                $context->addTask(new Task($archiveTask->name));
            }
        }
        return $archive;
    }

    public function addContext(Context $newContext): Context
    {
        $context = $this->contexts->findBy('name', $newContext->name);
        if ($context->isEmpty()) {
            $this->contexts->addItem($newContext);
            return $newContext;
        }
        return $context->first();
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    public function isEmpty(): bool
    {
        return $this->contexts->isEmpty();
    }

    public function getContextCollection(): ContextCollection
    {
        return $this->contexts;
    }

    public function jsonSerialize(): mixed
    {
        return $this->contexts->toArray();
    }
}