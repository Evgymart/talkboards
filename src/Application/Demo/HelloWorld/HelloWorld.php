<?php

declare(strict_types=1);

namespace TalkBoards\Application\Demo\HelloWorld;

use TalkBoards\Infrastructure\MessageBus\Message;

/**
 * @implements Message<string>
 */
final readonly class HelloWorld implements Message
{
    public function __construct(
        public string $parameter,
    ) {}
}
