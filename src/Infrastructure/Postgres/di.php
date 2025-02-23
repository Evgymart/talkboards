<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $di): void {
    $di->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
        ->set(PostgresConnectionWrapper::class)->args([
            '$host' => '%env(string:key:host:url:DATABASE_URL)%',
            '$port' => '%env(int:key:port:url:DATABASE_URL)%',
            '$user' => '%env(string:key:user:url:DATABASE_URL)%',
            '$password' => '%env(string:key:pass:url:DATABASE_URL)%',
            '$dbName' => '%env(string:key:path:url:DATABASE_URL)%',
        ])
        ->set(Mapper::class)
        ->set(PostgresConnection::class)->args([
            '$wrapper' => service(PostgresConnectionWrapper::class),
        ]);
};
