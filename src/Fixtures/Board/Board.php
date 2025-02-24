<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Board;

use TalkBoards\Infrastructure\Uuid\Uuid;

final readonly class Board
{
    /**
     * @param non-empty-string $name
     * @param non-empty-string $description
     */
    public function __construct(
        public Uuid $boardId,
        public string $name,
        public string $description,
        public \DateTimeImmutable $createdAt,
    ) {}
}
