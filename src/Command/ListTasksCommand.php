<?php

namespace App\Command;

use App\Domain\Context;
use App\Domain\Task;
use App\Infrastructure\ArchiveStorage;
use App\Infrastructure\TaskListFormatter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'list-tasks',
    description: 'List all tasks',
    hidden: false,
    aliases: ['list', 'l']
)]
class ListTasksCommand extends Command
{
    const DEFAULT_CONTEXT = 'default';

    public function __construct(private ArchiveStorage $archiveStorage)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $contextName = $input->getArgument('context') ?? self::DEFAULT_CONTEXT;

        $archive = $this->archiveStorage->getArchive();

        TaskListFormatter::display($archive);

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to list tasks and contexts')
            ->addArgument('context', InputArgument::OPTIONAL, 'task context name')
        ;
    }
}