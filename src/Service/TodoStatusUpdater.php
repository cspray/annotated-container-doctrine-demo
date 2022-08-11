<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Service;

use Cspray\AnnotatedContainer\Attribute\Service;
use Cspray\AnnotatedContainerDoctrineDemo\Doctrine\PersistenceManager;
use Cspray\AnnotatedContainerDoctrineDemo\Doctrine\Repository\TodoRepository;
use Cspray\AnnotatedContainerDoctrineDemo\Entity\Todo;
use Cspray\AnnotatedContainerDoctrineDemo\Model\TodoStatus;

#[Service]
class TodoStatusUpdater {

    public function __construct(
        private readonly TodoRepository $todoRepository,
        private readonly PersistenceManager $persistenceManager
    ) {}

    public function markDone(Todo $todo) : Todo {
        $todo->setStatus(TodoStatus::Done);
        $todo = $this->todoRepository->save($todo);
        $this->persistenceManager->persist();
        return $todo;
    }

}