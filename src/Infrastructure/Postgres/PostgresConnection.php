<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

final readonly class PostgresConnection
{
    private Connection $connection;

    public function __construct(
        string $host,
        int $port,
        string $user,
        string $password,
        string $dbName,
    ) {
        $this->connection = DriverManager::getConnection([
            'dbname' => $dbName,
            'user' => $user,
            'password' => $password,
            'host' => $host,
            'port' => $port,
            'driver' => 'pdo_pgsql',
        ]);
    }

    /**
     * @param non-empty-string $sql
     * @param array<non-empty-string, mixed> $params
     * @throws Exception
     */
    public function execute(string $sql, array $params = []): mixed
    {
        $stmt = $this->connection->prepare($sql);

        return $stmt->executeQuery($params);
    }
}
