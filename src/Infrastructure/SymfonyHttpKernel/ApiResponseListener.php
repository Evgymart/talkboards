<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyHttpKernel;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final readonly class ApiResponseListener
{
    public function __construct(
        private NormalizerInterface $normalizer,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    #[AsEventListener]
    public function __invoke(ViewEvent $event): void
    {
        if ($event->getRequest()->getRequestFormat() !== 'json') {
            return;
        }

        $result = $event->getControllerResult();
        $statusCode = HttpStatusCode::OK;

        if ($result instanceof ResponseWithStatus) {
            $statusCode = $result->statusCode;
            $result = $result->result;
        }

        $normalized = $this->normalizer->normalize($result);

        $data = json_encode($normalized, JsonResponse::DEFAULT_ENCODING_OPTIONS | JSON_UNESCAPED_UNICODE) ?: '';
        $event->setResponse(JsonResponse::fromJsonString(
            data: $data,
            status: $statusCode->value,
        ));
    }
}
