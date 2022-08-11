<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine;

enum DatabasePath {
    case Dev;
    case Test;
    case Prod;

    public function getPath() : string {
        $dir = dirname(__DIR__, 2);
        return match($this) {
            self::Dev => $dir . '/data/dev.sqlite',
            self::Test => $dir . '/data/test.sqlite',
            self::Prod => $dir . '/data/prod.sqlite'
        };
    }
}
