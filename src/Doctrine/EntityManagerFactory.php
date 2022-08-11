<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine;

use Cspray\AnnotatedContainer\Attribute\ServiceDelegate;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;

final class EntityManagerFactory {

    #[ServiceDelegate]
    public function createEntityManager(DatabaseConfiguration $configuration) : EntityManagerInterface {
        $conn = [
            'driver' => $configuration->driver->value,
            'path' => $configuration->path->getPath()
        ];
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [dirname(__DIR__) . '/Entity'],
            $configuration->isDevMode
        );
        $config->setNamingStrategy(
            new UnderscoreNamingStrategy()
        );

        foreach ($configuration->customTypes as $type => $class) {
            if (!Type::hasType($type)) {
                Type::addType($type, $class);
            }
        }

        return EntityManager::create($conn, $config);
    }

}