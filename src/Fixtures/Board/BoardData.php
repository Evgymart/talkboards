<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Board;

use TalkBoards\Fixtures\FixtureConstants;
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
                boardId: Uuid::fromString(FixtureConstants::BOARD_ID_ANIME),
                name: 'anime',
                description: 'A board dedicated to anime',
                createdAt: FixtureConstants::createdAt(),
            ),
            new Board(
                boardId: Uuid::fromString(FixtureConstants::BOARD_ID_MANGA),
                name: 'manga',
                description: 'A board dedicated to manga',
                createdAt: FixtureConstants::createdAt(),
            ),
            new Board(
                boardId: Uuid::fromString(FixtureConstants::BOARD_ID_MOVIES),
                name: 'movies',
                description: 'A board dedicated to movies',
                createdAt: FixtureConstants::createdAt(),
            ),
            new Board(
                boardId: Uuid::fromString(FixtureConstants::BOARD_ID_BOOKS),
                name: 'books',
                description: 'A board dedicated to books',
                createdAt: FixtureConstants::createdAt(),
            ),
        ];
    }
}
