<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyHttpKernel;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerBuilder $containerBuilder, ContainerConfigurator $di): void {
    $containerBuilder->addCompilerPass(new RemoveLocaleListenersPass());

    $di->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
        ->set(ApiResponseListener::class);
};
