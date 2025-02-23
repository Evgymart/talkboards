<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

use Doctrine\DBAL\Connection;

interface ConnectionWrapper
{
    public function getConnection(): Connection;
}
