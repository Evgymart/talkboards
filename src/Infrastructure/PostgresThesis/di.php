<?php

declare(strict_types=1);

namespace App\Infrastructure\PostgresThesis;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use TalkBoards\Infrastructure\DependencyInjection\Module;
use TalkBoards\Infrastructure\PostgresThesis\DependencyInjection\AddValueResolverCompilerPass;
use TalkBoards\Infrastructure\PostgresThesis\PostgresConnection;
use TalkBoards\Infrastructure\PostgresThesis\ValinorIntegration\ValinorHydrator;
use TalkBoards\Infrastructure\PostgresThesis\ValueResolver\UuidResolver;
use Thesis\Result\Hydrator;
use Thesis\StatementContext\ValueResolver;
use Thesis\StatementContext\ValueResolverRegistry;
use Thesis\StatementContext\ValueResolverRegistry\ContainerValueResolverRegistry;

return static function (ContainerConfigurator $di, ContainerBuilder $containerBuilder): void {
    $containerBuilder->addCompilerPass(new AddValueResolverCompilerPass());
    $containerBuilder->registerForAutoconfiguration(ValueResolver::class)->addTag(ValueResolver::class);

    Module::create($di)
        ->set(PostgresConnection::class)->args([
            '$host' => '%env(POSTGRES_HOST)%',
            '$port' => '%env(POSTGRES_PORT)%',
            '$user' => '%env(POSTGRES_USER)%',
            '$password' => '%env(POSTGRES_PASSWORD)%',
            '$dbName' => '%env(POSTGRES_DB)%',
        ])
        ->set(ValinorHydrator::class)
        ->alias(Hydrator::class, ValinorHydrator::class)
        ->set(ContainerValueResolverRegistry::class)
        ->alias(ValueResolverRegistry::class, ContainerValueResolverRegistry::class)
        ->set(UuidResolver::class);
};
