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
        if (!$this->archiveNotExists()) {
            $this->filesystem->mkdir($this->getArchiveDirectory());
            $this->filesystem->touch($this->getArchivePath());
        }
        $this->filesystem->dumpFile($this->getArchivePath(), $archive->toJson());
    }

    private function archiveNotExists(): bool
    {
        return !$this->filesystem->exists($this->getArchivePath());
    }

    /**
     * @return string
     */
    private function getArchivePath(): string
    {
        return $this->getArchiveDirectory() . '/archive.json';
    }

    private function getArchiveDirectory(): string
    {
        return realpath('~/.terminal-tasks');
    }

}