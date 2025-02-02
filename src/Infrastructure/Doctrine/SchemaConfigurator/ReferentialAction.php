<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\SchemaConfigurator;

enum ReferentialAction: string
{
    case NO_ACTION = 'no action';
    case CASCADE = 'cascade';
    case RESTRICT = 'restrict';
    case SET_NULL = 'set null';
    case SET_DEFAULT = 'set default';
}
