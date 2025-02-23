<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

final readonly class ConnectionData
{
    public function __construct(
        public string $host,
        public int $port,
        public string $user,
        public string $password,
        public string $dbName,
    ) {}
}
