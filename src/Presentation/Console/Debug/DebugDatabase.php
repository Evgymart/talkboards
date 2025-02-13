<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\Debug;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Console\Input\InputInterface;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleCommand;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\Output;

final class DebugDatabase extends ConsoleCommand
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
        parent::__construct(self::name());
    }

    protected static function name(): string
    {
        return 'debug-database';
    }

    protected function doExecute(InputInterface $input, Output $output): int
    {
        $result = $this->connection->executeQuery('select * from board.board');
        $output->dump($result->fetchAllAssociative());

        return self::SUCCESS;
    }
}
