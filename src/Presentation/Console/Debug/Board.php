<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\Debug;

use TalkBoards\Infrastructure\Uuid\Uuid;

final readonly class Board
{
    public function __construct(
        public Uuid $boardId,
        public string $name,
        public string $description,
        public \DateTimeImmutable $createdAt,
    ) {}
}
