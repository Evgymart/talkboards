<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Api\V1\Board\Search;

final readonly class Board
{
    public function __construct(
        public string $name,
        public string $description,
        public \DateTimeImmutable $createdAt,
    ) {}
}
