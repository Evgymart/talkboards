<?php

declare(strict_types=1);

namespace TalkBoards\Feature\Demo\HelloWorld\Handler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use TalkBoards\Feature\Demo\HelloWorld\HelloWorld;

#[AsMessageHandler]
final readonly class HelloWorldHandler
{
    public function __invoke(HelloWorld $message): string
    {
        return \sprintf('parameter: %s', $message->parameter);
    }
}
