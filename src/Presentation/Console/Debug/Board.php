<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\Debug;

final readonly class Board
{
    public function __construct(
        public string $board_id,
        public string $name,
        public string $description,
        public string $created_at,
    ) {}
}
