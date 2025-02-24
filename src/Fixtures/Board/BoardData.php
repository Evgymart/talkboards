<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Board;

use TalkBoards\Infrastructure\Uuid\Uuid;

final readonly class BoardData
{
    /**
     * @return Board[]
     */
    public static function get(): array
    {
        return [
            new Board(
                boardId: Uuid::fromString('32f1eacf-acf7-46a7-a7f2-68224e9e3c7f'),
                name: 'anime',
                description: 'A board dedicated to anime',
                createdAt: new \DateTimeImmutable(),
            ),
            new Board(
                boardId: Uuid::fromString('565a4d8e-8818-474d-a4e9-3b0b5a76c3f0'),
                name: 'manga',
                description: 'A board dedicated to manga',
                createdAt: new \DateTimeImmutable(),
            ),
            new Board(
                boardId: Uuid::fromString('e0dc5a06-782f-4da3-bf85-a3b108fa4b21'),
                name: 'movies',
                description: 'A board dedicated to movies',
                createdAt: new \DateTimeImmutable(),
            ),
            new Board(
                boardId: Uuid::fromString('4a981193-30db-4463-ab22-e4c60f92d289'),
                name: 'books',
                description: 'A board dedicated to books',
                createdAt: new \DateTimeImmutable(),
            ),
        ];
    }
}
