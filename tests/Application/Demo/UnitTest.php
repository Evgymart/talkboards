<?php

declare(strict_types=1);

namespace TalkBoards\Application\Demo;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

#[Group('unit')]
#[CoversNothing]
final class UnitTest extends TestCase
{
    public function testBasic(): void
    {
        assertEquals(5, 5);
    }
}
