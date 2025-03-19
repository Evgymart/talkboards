<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Post;

use TalkBoards\Fixtures\FixtureConstants;
use TalkBoards\Infrastructure\Uuid\Uuid;

final readonly class PostData
{
    /**
     * @return Post[]
     */
    public static function get(): array
    {
        return [
            new Post(
                postId: Uuid::fromString('247a96ef-3e11-4661-a9d1-8f450354d5a2'),
                boardId: Uuid::fromString(FixtureConstants::BOARD_ID_ANIME),
                userId: Uuid::fromString(FixtureConstants::USER_1),
                title: 'What is your favorite anime',
                text: 'My favorite anime is death note. What about you?',
                createdAt: FixtureConstants::createdAt(),
                updatedAt: FixtureConstants::updatedAt(),
            ),
            new Post(
                postId: Uuid::fromString('dd8b9065-aae7-4ce1-ac33-bf6b904dd5f0'),
                boardId: Uuid::fromString(FixtureConstants::BOARD_ID_BOOKS),
                userId: Uuid::fromString(FixtureConstants::USER_1),
                title: 'What is your favorite book',
                text: 'My favorite book is 1984. What about you?',
                createdAt: FixtureConstants::createdAt(),
                updatedAt: FixtureConstants::updatedAt(),
            ),
            new Post(
                postId: Uuid::fromString('e1578b58-4a60-4fec-abf2-f628aa799298'),
                boardId: Uuid::fromString(FixtureConstants::BOARD_ID_MOVIES),
                userId: Uuid::fromString(FixtureConstants::USER_1),
                title: 'What is your favorite movie',
                text: 'My favorite anime is The Godfather. What about you?',
                createdAt: FixtureConstants::createdAt(),
                updatedAt: FixtureConstants::updatedAt(),
            ),
        ];
    }
}
