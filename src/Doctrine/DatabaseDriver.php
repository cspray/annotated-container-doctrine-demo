<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine;

enum DatabaseDriver : string {
    case Sqlite = 'pdo_sqlite';
}
