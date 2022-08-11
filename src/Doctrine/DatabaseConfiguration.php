<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Doctrine;

use Cspray\AnnotatedContainer\Attribute\Configuration;
use Cspray\AnnotatedContainer\Attribute\Inject;
use Ramsey\Uuid\Doctrine\UuidType;

#[Configuration]
final class DatabaseConfiguration {

    #[Inject(DatabaseDriver::Sqlite)]
    public readonly DatabaseDriver $driver;

    #[Inject(DatabasePath::Dev, profiles: ['dev'])]
    #[Inject(DatabasePath::Test, profiles: ['test'])]
    #[Inject(DatabasePath::Prod, profiles: ['prod'])]
    public readonly DatabasePath $path;

    #[Inject([
        UuidType::NAME => UuidType::class
    ])]
    public readonly array $customTypes;

    #[Inject(true, profiles: ['dev', 'test'])]
    #[Inject(false, profiles: ['prod'])]
    public readonly bool $isDevMode;

}