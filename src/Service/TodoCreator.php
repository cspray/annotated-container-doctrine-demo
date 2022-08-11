<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Service;

use Cspray\AnnotatedContainer\Attribute\Service;
use Cspray\AnnotatedContainerDoctrineDemo\Doctrine\PersistenceManager;
use Cspray\AnnotatedContainerDoctrineDemo\Doctrine\Repository\TodoRepository;
use Cspray\AnnotatedContainerDoctrineDemo\Entity\Todo;

#[Service]
class TodoCreator {

    public function __construct(
        private readonly TodoRepository $todoRepository,
        private readonly PersistenceManager $persistenceManager
    ) {}

    public function createTodo(Todo $todo) : Todo {
        // Normally you'd validate this before saving it!
        $todo = $this->todoRepository->save($todo);
        $this->persistenceManager->persist();
        return $todo;
    }

}