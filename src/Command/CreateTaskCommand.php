<?php

namespace App\Command;

use App\Domain\Context;
use App\Domain\Task;
use App\Infrastructure\ArchiveStorage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'create-task',
    description: 'Creates a new task',
    hidden: false,
    aliases: ['task', 't']
)]
class CreateTaskCommand extends Command
{
    const DEFAULT_CONTEXT = 'default';

    public function __construct(private ArchiveStorage $archiveStorage)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $taskName = $input->getArgument('task');
        $contextName = $input->getArgument('context') ?? self::DEFAULT_CONTEXT;

        $archive = $this->archiveStorage->getArchive();
        $context = $archive->addContext(new Context($contextName));
        $context->addTask(new Task($taskName));

        $this->archiveStorage->saveArchive($archive);

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to create new task')
            ->addArgument('task', InputArgument::REQUIRED, 'task name')
            ->addArgument('context', InputArgument::OPTIONAL, 'task context name')
        ;
    }
}