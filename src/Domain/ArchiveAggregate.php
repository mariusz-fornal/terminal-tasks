<?php

declare(strict_types=1);

namespace App\Domain;

class ArchiveAggregate
{
    private ContextCollection $contexts;

    public function __construct(array $archive = [])
    {
        $this->contexts = self::import($archive);
    }

    private static function import(array $archive): ContextCollection
    {
        return new ContextCollection();
    }

    public function addTask()
    {

    }

    public function addContext(Context $newContext): Context
    {
        $context = $this->contexts->findBy('name', $newContext->name);
        if (empty($context)) {
            $this->contexts->addItem($newContext);
            return $newContext;
        }
        return $context;
    }

    public function removeContext(): void
    {

    }

    public function contextExists(string $name): bool
    {
        return $this->contexts->find($name);
    }

    public function toJson(): string
    {
        return json_encode($this->contexts->toArray());
    }

    public function isEmpty(): bool
    {
        return $this->contexts->isEmpty();
    }

    public function getContextCollection(): ContextCollection
    {
        return $this->contexts;
    }
}