<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\Debug;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {

    $di->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->set(DebugDatabase::class);
};
