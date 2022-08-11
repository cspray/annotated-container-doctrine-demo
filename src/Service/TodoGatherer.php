<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Service;

use Cspray\AnnotatedContainer\Attribute\Service;
use Cspray\AnnotatedContainerDoctrineDemo\Doctrine\Repository\TodoRepository;
use Cspray\AnnotatedContainerDoctrineDemo\Entity\Todo;
use Generator;
use Ramsey\Uuid\UuidInterface;

#[Service]
class TodoGatherer {

    public function __construct(
        private readonly TodoRepository $todoRepository
    ) {}

    public function findById(UuidInterface $id) : ?Todo {
        return $this->todoRepository->find($id);
    }

    public function getAllTodos() : Generator {
        foreach ($this->todoRepository->findAll() as $item) {
            assert($item instanceof Todo);
            yield $item;
        }
    }

}