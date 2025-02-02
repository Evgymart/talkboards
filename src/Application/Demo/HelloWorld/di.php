<?php

declare(strict_types=1);

namespace TalkBoards\Application\Demo\HelloWorld;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use TalkBoards\Application\Demo\HelloWorld\Handler\HelloWorldHandler;

return static function (ContainerConfigurator $di): void {
    $services = $di->services();

    $services
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->set(HelloWorldHandler::class)
        ->tag('messenger.message_handler');
};
