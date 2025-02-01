<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\HelloWorld;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {

    $di->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->set(HelloCommand::class);
};
