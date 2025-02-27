<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Api\V1\HelloWorld;

final readonly class Response
{
    public function __construct(
        public string $message,
        public string $param,
    ) {}
}
