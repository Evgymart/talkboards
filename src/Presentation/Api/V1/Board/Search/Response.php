<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Api\V1\Board\Search;

final readonly class Response
{
    /**
     * @param Board[] $boards
     */
    public function __construct(
        public array $boards,
    ) {}
}
