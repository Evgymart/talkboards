<?php

declare(strict_types=1);

namespace TalkBoards\Persistence\Board;

use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaConfigurator;
use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaSubscriber;

final readonly class BoardSchema implements SchemaSubscriber
{
    public function configureSchema(SchemaConfigurator $schema): void
    {
        $schema
            ->table('board.board')
            ->uuidColumn('id')
            ->stringColumn('name')
            ->textColumn('description')
            ->dateColumn('created_at')
            ->primaryKey('id');
    }
}
