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

    public function addContext()
    {

    }

    public function removeContext(): void
    {

    }

    public function contextExists(string $name): bool
    {
        return $this->contexts->find($name);
    }
}