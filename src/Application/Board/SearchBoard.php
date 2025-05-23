<?php

declare(strict_types=1);

namespace TalkBoards\Application\Board;

use TalkBoards\Infrastructure\MessageBus\Message;

/**
 * @implements Message<list<Board>>
 */
final readonly class SearchBoard implements Message
{
    public function __construct(
        public string $query,
    ) {}
}
