<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Attribute;

use Cspray\AnnotatedContainer\Attribute\ServiceAttribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class Repository implements ServiceAttribute {

    public function __construct(
        private readonly array $profiles = []
    ) {}

    public function getProfiles() : array {
        return $this->profiles;
    }

    public function isPrimary() : bool {
        return false;
    }

    public function getName() : ?string {
        return null;
    }
}