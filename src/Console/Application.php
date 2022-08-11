<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Console;

use Cspray\AnnotatedContainer\Attribute\Service;
use Symfony\Component\Console\Application as ConsoleApplication;

#[Service]
class Application extends ConsoleApplication {

}