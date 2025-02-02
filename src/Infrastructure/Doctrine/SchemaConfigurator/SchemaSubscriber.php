<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\SchemaConfigurator;

interface SchemaSubscriber
{
    public function configureSchema(SchemaConfigurator $schema): void;
}
