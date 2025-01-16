<?php

declare(strict_types=1);

namespace TalkBoards\Api\V1\HelloWorld;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use TalkBoards\Feature\Demo\HelloWorld\HelloWorld;

final readonly class Action
{
    #[Route('/hello-world', name: 'helloWorld', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload]
        Request $request,
        MessageBusInterface $messageBus,
    ): Response {
        $envelope = $messageBus->dispatch(new HelloWorld($request->param));
        $handledStamp = $envelope->last(HandledStamp::class);
        /** @var string $result */
        $result = $handledStamp?->getResult();

        return new Response(
            message: 'Hello World!',
            param: $result,
        );
    }
}
