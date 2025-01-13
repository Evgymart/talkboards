<?php

declare(strict_types=1);

namespace TalkBoards\Api\V1\HelloWorld;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

final readonly class Action
{
    #[Route('/hello-world', name: 'helloWorld', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload]
        Request $request,
    ): Response {
        return new Response(
            message: 'Hello World!',
            param: $request->param,
        );
    }
}
