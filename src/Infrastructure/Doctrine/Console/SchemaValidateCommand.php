<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\Console;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Metadata\Storage\TableMetadataStorageConfiguration;
use Doctrine\Migrations\Provider\SchemaProvider;
use Symfony\Component\Console\Input\InputInterface;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleCommand;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\Output;

final class SchemaValidateCommand extends ConsoleCommand
{
    public function __construct(
        private readonly SchemaProvider $schemaProvider,
        private readonly Configuration $configuration,
        private readonly Connection $connection,
    ) {
        parent::__construct();
    }

    #[\Override]
    protected static function name(): string
    {
        return 'schema:validate';
    }

    /**
     * @throws Exception
     */
    #[\Override]
    protected function doExecute(InputInterface $input, Output $output): int
    {
        $schemaManager = $this->connection->createSchemaManager();
        $databaseSchema = $schemaManager->introspectSchema();
        $applicationSchema = $this->schemaProvider->createSchema();
        $schemaDiff = $schemaManager->createComparator()->compareSchemas($databaseSchema, $applicationSchema);
        $storageConfiguration = $this->configuration->getMetadataStorageConfiguration();

        $sql = array_filter(
            $this->connection->getDatabasePlatform()->getAlterSchemaSQL($schemaDiff),
            static fn(string $query): bool => $storageConfiguration instanceof TableMetadataStorageConfiguration
                && !str_contains($query, $storageConfiguration->getTableName()),
        );

        if ($sql === []) {
            $output->success('Schema is up to date.');

            return self::SUCCESS;
        }

        $output->error('Schema is not up to date.');
        $output->writeln($sql);

        return self::FAILURE;
    }
}
