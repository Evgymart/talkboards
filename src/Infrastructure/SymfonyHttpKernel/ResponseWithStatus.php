<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyHttpKernel;

final readonly class ResponseWithStatus
{
    public function __construct(
        public mixed $result,
        public HttpStatusCode $statusCode,
    ) {}
}
