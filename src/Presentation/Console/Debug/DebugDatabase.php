<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\Debug;

use Symfony\Component\Console\Input\InputInterface;
use TalkBoards\Infrastructure\Postgres\PostgresConnection;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleCommand;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\Output;

final class DebugDatabase extends ConsoleCommand
{
    public function __construct(
        private PostgresConnection $connection,
    ) {
        parent::__construct(self::name());
    }

    protected static function name(): string
    {
        return 'debug-database';
    }

    protected function doExecute(InputInterface $input, Output $output): int
    {
        $result = $this->connection->execute('select * from board.board');
        $output->dump($result->fetchAllAssociative());

        return self::SUCCESS;
    }
}
