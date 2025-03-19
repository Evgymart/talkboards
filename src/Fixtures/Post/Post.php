<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Post;

use TalkBoards\Infrastructure\Uuid\Uuid;

final readonly class Post
{
    /**
     * @param non-empty-string $title
     */
    public function __construct(
        public Uuid $postId,
        public Uuid $boardId,
        public Uuid $userId,
        public string $title,
        public string $text,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $updatedAt,
    ) {}
}
