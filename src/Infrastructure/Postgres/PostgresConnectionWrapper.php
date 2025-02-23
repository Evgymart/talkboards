<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

final readonly class PostgresConnectionWrapper implements ConnectionWrapper
{
    public function __construct(
        private string $host,
        private int $port,
        private string $user,
        private string $password,
        private string $dbName,
    ) {}

    public function getConnection(): Connection
    {
        return DriverManager::getConnection([
            'dbname' => $this->dbName,
            'user' => $this->user,
            'password' => $this->password,
            'host' => $this->host,
            'port' => $this->port,
            'driver' => 'pdo_pgsql',
        ]);
    }
}
