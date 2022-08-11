<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Console\Command;

use Cspray\AnnotatedContainerDoctrineDemo\Attribute\CliCommand;
use Cspray\AnnotatedContainerDoctrineDemo\Service\TodoGatherer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[CliCommand]
class ListTodoCommand extends Command {

    public function __construct(
        private readonly TodoGatherer $todoGatherer
    ) {
        parent::__construct();
    }

    protected function configure() {
        parent::configure();
        $this->setName('list-todo');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $outputHelper = new SymfonyStyle($input, $output);
        $table = [

        ];
        foreach ($this->todoGatherer->getAllTodos() as $todo) {
            $table[] = [
                'ID' => $todo->getId()->toString(),
                'Title' => $todo->getTitle(),
                'Status' => $todo->getStatus()->value
            ];
        }

        $outputHelper->table(
            [
                'ID',
                'Title',
                'Status'
            ],
            $table
        );
        return self::SUCCESS;
    }

}