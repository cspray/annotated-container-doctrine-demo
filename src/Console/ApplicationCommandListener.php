<?php

namespace Cspray\AnnotatedContainerDoctrineDemo\Console;

use Cspray\AnnotatedContainer\AnnotatedContainerEvent;
use Cspray\AnnotatedContainer\AnnotatedContainerLifecycle;
use Cspray\AnnotatedContainer\AnnotatedContainerListener;
use Cspray\AnnotatedContainer\ContainerDefinition;
use Symfony\Component\Console\Command\Command;

final class ApplicationCommandListener implements AnnotatedContainerListener {

    private ?ContainerDefinition $containerDefinition = null;

    public function handle(AnnotatedContainerEvent $event) : void {
        if ($event->getLifecycle() === AnnotatedContainerLifecycle::BeforeContainerCreation) {
            $this->containerDefinition = $event->getTarget();
        } else if ($event->getLifecycle() === AnnotatedContainerLifecycle::AfterContainerCreation) {
            $container = $event->getTarget();
            /** @var Application $app */
            $app = $container->get(Application::class);
            foreach ($this->containerDefinition->getServiceDefinitions() as $serviceDefinition) {
                if ($serviceDefinition->isAbstract()) {
                    continue;
                }

                if (is_a($serviceDefinition->getType()->getName(), Command::class, true)) {
                    $app->add($container->get($serviceDefinition->getType()->getName()));
                }
            }
        }
    }
}