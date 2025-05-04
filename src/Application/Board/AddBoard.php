<?php

declare(strict_types=1);

namespace TalkBoards\Application\Board;

use TalkBoards\Infrastructure\MessageBus\Message;
use TalkBoards\Infrastructure\Uuid\Uuid;

/**
 * @implements Message<void>
 */
final readonly class AddBoard implements Message
{
    public function __construct(
        public Uuid $boardId,
        public string $name,
        public string $description,
        public \DateTimeImmutable $createdAt,
    ) {}
}
