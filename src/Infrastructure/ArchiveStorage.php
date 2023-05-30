<?php

namespace App\Infrastructure;

use App\Domain\ArchiveAggregate;
use Symfony\Component\Filesystem\Filesystem;

class ArchiveStorage
{

    public function __construct(private Filesystem $filesystem) {}

    public function getArchive(): ArchiveAggregate
    {
        return new ArchiveAggregate();
    }

    public function saveArchive(ArchiveAggregate $archive): void
    {
        $archive->
    }
}