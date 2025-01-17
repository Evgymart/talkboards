<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\MessageBus;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessageBus
{
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
    ) {
        $this->messageBus = $messageBus;
    }

    /**
     * @template TResult
     * @template TMessage of Message<TResult>
     * @param TMessage $message
     * @return TResult
     */
    public function execute(object $message): mixed
    {
        /** @var TResult */
        return $this->handle($message);
    }
}
