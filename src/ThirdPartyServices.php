<?php

namespace Cspray\AnnotatedContainerDoctrineDemo;

use Cspray\AnnotatedContainer\ContainerDefinitionBuilderContext;
use Cspray\AnnotatedContainer\ContainerDefinitionBuilderContextConsumer;
use Doctrine\ORM\EntityManagerInterface;
use function Cspray\AnnotatedContainer\service;
use function Cspray\Typiphy\objectType;

class ThirdPartyServices implements ContainerDefinitionBuilderContextConsumer {

    public function consume(ContainerDefinitionBuilderContext $context) : void {
        service($context, objectType(EntityManagerInterface::class));
    }

}