<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\MessageBus;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $di->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
        ->set(MessageBus::class);
};
