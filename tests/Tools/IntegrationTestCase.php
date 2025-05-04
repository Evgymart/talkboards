<?php

declare(strict_types=1);

namespace TalkBoards\Tools;

use PHPUnit\Framework\TestCase;
use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaSubscriber;

abstract class IntegrationTestCase extends TestCase
{
    /**
     * @return list<class-string<SchemaSubscriber>|SchemaSubscriber>
     */
    protected function schema(): array
    {
        return [];
    }

    /**
     * @return list<class-string>
     */
    protected function doctrineSchema(): array
    {
        return [];
    }
}
