<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\Debug;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {

    $di->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->set(DebugDatabase::class)->args([
            '$host' => '%env(POSTGRES_HOST)%',
            '$port' => '%env(POSTGRES_PORT)%',
            '$user' => '%env(POSTGRES_USER)%',
            '$password' => '%env(POSTGRES_PASSWORD)%',
            '$dbName' => '%env(POSTGRES_DB)%',
        ]);
};
