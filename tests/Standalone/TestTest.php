<?php

declare(strict_types=1);

namespace TalkBoards\Standalone;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
final class TestTest extends TestCase
{
    public function testTest(): void
    {
        /**
         * @phpstan-ignore-next-line
         */
        self::assertTrue(true);
    }
}
