<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\SchemaConfigurator;

final readonly class SchemaSubscriberChain implements SchemaSubscriber
{
    /**
     * @param iterable<SchemaSubscriber> $subscribers
     */
    public function __construct(
        private iterable $subscribers = [],
    ) {}

    #[\Override]
    public function configureSchema(SchemaConfigurator $schema): void
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->configureSchema($schema);
        }
    }
}
