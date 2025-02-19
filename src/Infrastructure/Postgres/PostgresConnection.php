<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Result;

final readonly class PostgresConnection
{
    private Connection $connection;

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
        } catch (\Throwable $e) {
            throw new DatabaseException(\sprintf('Unable to connect to the database: %s', $e->getMessage()));
        }
    }

    /**
     * @param non-empty-string $sql
     * @param array<non-empty-string, mixed> $params
     * @throws DatabaseException
     */
    public function execute(string $sql, array $params = []): Result
    {
        try {
            return $this->connection->prepare($sql)
                ->executeQuery($params);
        } catch (\Throwable $e) {
            throw new DatabaseException(\sprintf(
                "Unable to execute query: %s\nQuery: %s\nParams: %s",
                $e->getMessage(),
                $sql,
                json_encode($params, JSON_PRETTY_PRINT),
            ));
        }
    }
}
