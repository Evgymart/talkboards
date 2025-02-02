<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class CustomDoctrineType extends Type
{
    abstract public static function name(): string;

    final public function getName(): string
    {
        return static::name();
    }

    final public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
