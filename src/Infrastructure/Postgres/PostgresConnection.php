<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\TreeMapper;
use CuyZ\Valinor\MapperBuilder;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

final readonly class PostgresConnection
{
    private Connection $connection;

    private TreeMapper $mapper;

    /**
     * @throws DatabaseException
     */
    public function __construct(
        string $host,
        int $port,
        string $user,
        string $password,
        string $dbName,
    ) {
        try {
            $this->connection = DriverManager::getConnection([
                'dbname' => $dbName,
                'user' => $user,
                'password' => $password,
                'host' => $host,
                'port' => $port,
                'driver' => 'pdo_pgsql',
            ]);

            $this->mapper = (new MapperBuilder())->mapper();
        } catch (\Throwable $e) {
            throw new DatabaseException(\sprintf('Unable to connect to the database: %s', $e->getMessage()));
        }
    }

    /**
     * @template T of object
     * @param non-empty-string $sql
     * @param array<non-empty-string, non-empty-string> $params
     * @param null|class-string<T> $type
     * @return ($type is null ? array<non-empty-string, non-empty-string> : T)
     * @throws DatabaseException
     */
    public function execute(string $sql, array $params = [], ?string $type = null): null|array|object
    {
        try {
            // TODO: Make sure this works
            /** @var array<non-empty-string, non-empty-string> $data */
            $data = $this->connection->prepare($sql)
                 ->executeQuery($params)
                 ->fetchAssociative();

            if ($type === null) {
                return $data;
            }
        } catch (\Throwable $e) {
            throw new DatabaseException(\sprintf(
                "Unable to execute query: %s\nQuery: %s\nParams: %s",
                $e->getMessage(),
                $sql,
                json_encode($params, JSON_PRETTY_PRINT),
            ));
        }

        try {
            $mapped = $this->mapper->map($type, $data);
            if ($mapped instanceof $type) {
                return $mapped;
            }

            throw new \LogicException(\sprintf('Could not properly map the object to %s', $type));
        } catch (MappingError $e) {
            throw new DatabaseException(\sprintf(
                "Could not map the result data: %s\nError: %s",
                json_encode($data, JSON_PRETTY_PRINT),
                $e->getMessage(),
            ));
        }
    }
}
