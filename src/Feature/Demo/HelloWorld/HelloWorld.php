<?php

declare(strict_types=1);

namespace TalkBoards\Feature\Demo\HelloWorld;

final readonly class HelloWorld
{
    public function __construct(
        public string $parameter,
    ) {}
}
