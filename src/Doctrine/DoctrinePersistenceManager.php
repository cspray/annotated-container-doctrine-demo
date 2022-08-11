<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine;

use Cspray\AnnotatedContainer\Attribute\Service;
use Doctrine\ORM\EntityManagerInterface;

#[Service]
class DoctrinePersistenceManager implements PersistenceManager {

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function persist() : void {
        $this->entityManager->flush();
    }
}