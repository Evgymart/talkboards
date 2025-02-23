<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\Debug;

final readonly class Board
{
    public function __construct(
        public string $boardId,
        public string $name,
        public string $description,
        public string $createdAt,
    ) {}
}
