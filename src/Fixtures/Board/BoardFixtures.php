<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Board;

use Symfony\Component\Console\Input\InputInterface;
use TalkBoards\Infrastructure\PostgresThesis\PostgresConnection;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleCommand;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\Output;
use Thesis\StatementContext\Tsx;

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
        foreach (BoardData::get() as $board) {
            $this->connection->execute(
                static fn(Tsx $tsx): string => <<<SQL
                        insert into board.board(board_id, name, description, created_at)
                        values (
                            {$tsx($board->boardId)},
                            {$tsx($board->name)},
                            {$tsx($board->description)},
                            {$tsx($board->createdAt->format('Y-m-d H:i:sP'))}
                        );
                    SQL,
            );
        }

        return self::SUCCESS;
    }
}
