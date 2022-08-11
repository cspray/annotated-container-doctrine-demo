<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine;

use Cspray\AnnotatedContainer\Attribute\ServiceDelegate;
use Cspray\AnnotatedContainerDoctrineDemo\Doctrine\Repository\TodoRepository;
use Cspray\AnnotatedContainerDoctrineDemo\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;

final class RepositoryFactory {

    #[ServiceDelegate]
    public static function createTodoRepository(EntityManagerInterface $entityManager) : TodoRepository {
        $repo = $entityManager->getRepository(Todo::class);
        assert($repo instanceof TodoRepository);
        return $repo;
    }

}