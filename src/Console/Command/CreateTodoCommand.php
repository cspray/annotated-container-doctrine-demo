<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Console\Command;

use Cspray\AnnotatedContainerDoctrineDemo\Attribute\CliCommand;
use Cspray\AnnotatedContainerDoctrineDemo\Entity\Todo;
use Cspray\AnnotatedContainerDoctrineDemo\Service\TodoCreator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[CliCommand]
class CreateTodoCommand extends Command {

    public function __construct(
        private readonly TodoCreator $todoCreator
    ) {
        parent::__construct();
    }

    protected function configure() : void {
        parent::configure();
        $this->setName('create-todo');
        $this->setDescription('Provide a title and a new todo will be created.');
        $this->addArgument('title', InputArgument::REQUIRED, 'The title of the todo item.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $todo = Todo::newTask($input->getArgument('title'));
        $this->todoCreator->createTodo($todo);
        $output->writeln('<info>Successfully created todo!</info>');
        return self::SUCCESS;
    }

}