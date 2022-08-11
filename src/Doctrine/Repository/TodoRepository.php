<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine\Repository;

use Cspray\AnnotatedContainerDoctrineDemo\Attribute\Repository;
use Cspray\AnnotatedContainerDoctrineDemo\Entity\Todo;
use Doctrine\ORM\EntityRepository;

#[Repository]
final class TodoRepository extends EntityRepository {

    public function save(Todo $todo) : Todo {
        $this->getEntityManager()->persist($todo);
        return $todo;
    }

}