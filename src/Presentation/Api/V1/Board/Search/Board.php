<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Api\V1\Board\Search;

use TalkBoards\Application\Board\Search\Board as AppBoard;

final readonly class Board
{
    public function __construct(
        public string $name,
        public string $description,
        public \DateTimeImmutable $createdAt,
    ) {}

    public static function fromApp(AppBoard $board): self
    {
        return new self(
            name: $board->name,
            description: $board->description,
            createdAt: $board->createdAt,
        );
    }
}
