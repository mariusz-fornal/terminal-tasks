<?php

namespace App\Command;

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
    const DefaultContext = 'default';

    public function __construct(private ArchiveStorage $archiveStorage)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $task = $input->getArgument('task');
        $context = $input->getArgument('task') ?? self::DefaultContext;

        $archive = $this->archiveStorage->getArchive();
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