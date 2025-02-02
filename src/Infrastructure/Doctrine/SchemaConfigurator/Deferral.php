<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\SchemaConfigurator;

enum Deferral
{
    case DEFERRABLE_INITIALLY_DEFERRED;
    case DEFERRABLE_INITIALLY_IMMEDIATE;
    case NOT_DEFERRABLE;
}
