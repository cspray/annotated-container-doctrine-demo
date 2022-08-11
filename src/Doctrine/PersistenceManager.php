<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine;

use Cspray\AnnotatedContainer\Attribute\Service;

#[Service]
interface PersistenceManager {

    public function persist() : void;

}