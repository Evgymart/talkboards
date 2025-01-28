<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine;

use Doctrine\ORM\Tools\ToolEvents;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $di->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
        ->set(FixPostgresSQLDefaultSchemaListener::class)
        ->tag('doctrine.event_listener', ['event' => ToolEvents::postGenerateSchema]);
};
