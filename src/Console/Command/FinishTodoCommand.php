<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Console\Command;

use Cspray\AnnotatedContainerDoctrineDemo\Attribute\CliCommand;
use Cspray\AnnotatedContainerDoctrineDemo\Service\TodoGatherer;
use Cspray\AnnotatedContainerDoctrineDemo\Service\TodoStatusUpdater;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[CliCommand]
class FinishTodoCommand extends Command {

    public function __construct(
        private readonly TodoGatherer $todoGather,
        private readonly TodoStatusUpdater $statusUpdater
    ) {
        parent::__construct();
    }

    protected function configure() {
        parent::configure();
        $this->setName('finish-todo');
        $this->addArgument('todo-id', InputArgument::REQUIRED, 'The UUID for the todo to finish.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $id = $input->getArgument('todo-id');
        if (!Uuid::isValid($id)) {
            $output->writeln('<error>Please provide a valid UUID</error>');
            return self::FAILURE;
        }
        $todo = $this->todoGather->findById(Uuid::fromString($id));
        if ($todo === null) {
            $output->writeln('<error>Could not find a Todo with id ' . $id);
            return self::FAILURE;
        }

        $this->statusUpdater->markDone($todo);
        $output->writeln('<info>Successfully marked Todo done!</info>');
        return self::SUCCESS;
    }

}