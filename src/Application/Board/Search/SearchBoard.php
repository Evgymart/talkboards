<?php

declare(strict_types=1);

namespace TalkBoards\Application\Board\Search;

use TalkBoards\Infrastructure\MessageBus\Message;

/**
 * @implements Message<string>
 */
final readonly class SearchBoard implements Message
{
    public function __construct(
        public string $query,
    ) {}
}
