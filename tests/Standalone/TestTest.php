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
        self::assertTrue(true);
    }
}
