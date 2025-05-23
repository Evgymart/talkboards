<?php

declare(strict_types=1);

namespace TalkBoards\Application\Board\Handlers;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use TalkBoards\Application\Board\Board;
use TalkBoards\Application\Board\SearchBoard;
use TalkBoards\Infrastructure\PostgresThesis\PostgresConnection;
use TalkBoards\Infrastructure\Uuid\Uuid;
use Thesis\StatementContext\Tsx;

#[AsMessageHandler]
final readonly class SearchBoardHandler
{
    public function __construct(
        private PostgresConnection $connection,
    ) {}

    /**
     * @return Board[]
     */
    public function __invoke(SearchBoard $message): array
    {
        $result = $this->connection->execute(
            static fn(Tsx $tsx): string => <<<SQL
                    select board_id, name, description, created_at
                    from board.board
                    where name ilike {$tsx('%' . $message->query . '%')}
                    or description ilike {$tsx('%' . $message->query . '%')}
                SQL,
        )->toList();

        return array_map(static fn(array $board) => new Board(
            boardId: Uuid::fromString($board['board_id']),
            name: $board['name'],
            description: $board['description'],
            createdAt: \DateTimeImmutable::createFromFormat('Y-m-d H:i:s+P', $board['created_at'])
                ?: \DateTimeImmutable::createFromTimestamp(0),
        ), $result);
    }
}
