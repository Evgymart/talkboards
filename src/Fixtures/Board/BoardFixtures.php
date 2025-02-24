<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Board;

use Symfony\Component\Console\Input\InputInterface;
use TalkBoards\Infrastructure\Postgres\PostgresConnection;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleCommand;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\Output;

final class BoardFixtures extends ConsoleCommand
{
    public function __construct(
        private readonly PostgresConnection $connection,
        ?string $name = null,
    ) {
        parent::__construct($name);
    }

    protected static function name(): string
    {
        return 'fixtures:board';
    }

    protected function doExecute(InputInterface $input, Output $output): int
    {
        $sql = <<<'SQL'
                insert into board.board(board_id, name, description, created_at)
                values (:board_id, :name, :description, :created_at);
            SQL;

        foreach (BoardData::get() as $board) {
            $this->connection->execute($sql, [
                'board_id' => $board->boardId->toString(),
                'name' => $board->name,
                'description' => $board->description,
                'created_at' => $board->createdAt->format('Y-m-d H:i:sP'),
            ]);
        }

        return self::SUCCESS;
    }
}
