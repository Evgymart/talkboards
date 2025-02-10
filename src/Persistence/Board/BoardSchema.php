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
            ->table(name: 'board.board')
            ->uuidColumn(name: 'board_id')
            ->stringColumn(name: 'name')
            ->textColumn(name: 'description')
            ->dateColumn(name: 'created_at')
            ->primaryKey(column: 'board_id');
    }
}
