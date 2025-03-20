<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Api\V1\Board\Search;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use TalkBoards\Infrastructure\MessageBus\MessageBus;

final readonly class Action
{
    #[Route('/board/search', name: 'boardSearch', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload]
        Request $request,
        MessageBus $messageBus,
    ): Response {
        return new Response([
            new Board(
                name: 'anime',
                description: 'anime board',
                createdAt: new \DateTimeImmutable(),
            ),
        ]);
    }
}
