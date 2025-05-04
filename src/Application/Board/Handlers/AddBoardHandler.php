<?php

declare(strict_types=1);

namespace TalkBoards\Application\Board\Handlers;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use TalkBoards\Application\Board\AddBoard;
use TalkBoards\Infrastructure\PostgresThesis\PostgresConnection;
use Thesis\StatementContext\Tsx;

#[AsMessageHandler]
final readonly class AddBoardHandler
{
    public function __construct(
        private PostgresConnection $connection,
    ) {}

    public function __invoke(AddBoard $message): void
    {
        $this->connection->execute(
            static fn(Tsx $tsx): string => <<<SQL
                    insert into board.board(board_id, name, description, created_at)
                    values (
                        {$tsx($message->boardId)},
                        {$tsx($message->name)},
                        {$tsx($message->description)},
                        {$tsx($message->createdAt->format('Y-m-d H:i:sP'))}
                    )
                SQL,
        );
    }
}
