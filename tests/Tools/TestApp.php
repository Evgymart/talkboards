<?php

declare(strict_types=1);

namespace TalkBoards\Tools;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaConfigurator;
use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaSubscriber;
use TalkBoards\Infrastructure\Kernel;
use TalkBoards\Infrastructure\PostgresThesis\PostgresConnection;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleApplication;

final class TestApp
{
    private static ?Kernel $kernel = null;

    private static ?ContainerInterface $container = null;

    /**
     * @psalm-suppress MissingThrowsDocblock
     */
    public static function binConsole(string $command, OutputInterface $output = new NullOutput()): int
    {
        $application = new ConsoleApplication(self::kernel());
        $application->setAutoExit(false);

        return $application->run(new StringInput($command), $output);
    }

    public static function testThesisConnection(): PostgresConnection
    {
        /** @var PostgresConnection */
        return self::service(PostgresConnection::class);
    }

    public static function testDoctrineConnection(): Connection
    {
        /** @var Connection */
        return self::service('doctrine.dbal.default_connection');
    }

    /**
     * @template TServiceId of class-string<object>|string
     * @param TServiceId $serviceId
     * @return (TServiceId is class-string<object> ? object : object)
     */
    public static function service(string $serviceId): object
    {
        return self::container()->get($serviceId);
    }

    public static function applySchemaToTestConnection(SchemaSubscriber $schemaSubscriber): void
    {
        $connection = self::testDoctrineConnection();

        $schema = new Schema();
        $schemaSubscriber->configureSchema(new SchemaConfigurator($schema));

        foreach ($schema->toDropSql($connection->getDatabasePlatform()) as $sql) {
            $connection->executeStatement(str_replace(
                [
                    'DROP TABLE',
                    'ALTER TABLE',
                ],
                [
                    'DROP TABLE IF EXISTS',
                    'ALTER TABLE IF EXISTS',
                ],
                $sql,
            ));
        }

        foreach ($schema->toSql($connection->getDatabasePlatform()) as $sql) {
            $connection->executeStatement(str_replace('CREATE SCHEMA', 'CREATE SCHEMA IF NOT EXISTS', $sql));
        }
    }

    private static function container(): ContainerInterface
    {
        /** @var callable(): ContainerInterface */
        $getTestContainer = static fn(): object => self::kernel()->getContainer()->get('test.service_container');

        return self::$container ??= $getTestContainer();
    }

    private static function kernel(): Kernel
    {
        if (self::$kernel !== null) {
            return self::$kernel;
        }

        self::$kernel = new Kernel('test', true);
        self::$kernel->boot();

        return self::$kernel;
    }
}
