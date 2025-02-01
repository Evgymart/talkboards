<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Api\V1\HelloWorld;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use TalkBoards\Feature\Demo\HelloWorld\HelloWorld;
use TalkBoards\Infrastructure\MessageBus\MessageBus;

final readonly class Action
{
    #[Route('/hello-world', name: 'helloWorld', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload]
        Request $request,
        MessageBus $messageBus,
    ): Response {
        return new Response(
            message: 'Hello World!',
            param: $messageBus->execute(new HelloWorld($request->param)),
        );
    }
}
