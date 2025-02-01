<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyIntegration\HttpKernel;

final readonly class ResponseWithStatus
{
    public function __construct(
        public mixed $result,
        public HttpStatusCode $statusCode,
    ) {}
}
