<?php

declare(strict_types=1);

namespace TalkBoards\Persistence\Board;

use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaConfigurator;
use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaSubscriber;

final readonly class PostSchema implements SchemaSubscriber
{
    public function configureSchema(SchemaConfigurator $schema): void
    {
        $schema
            ->table(name: 'board.post')
            ->uuidColumn(name: 'post_id')
            ->uuidColumn(name: 'board_id')
            ->uuidColumn(name: 'user_id')
            ->stringColumn(name: 'title', length: 255)
            ->textColumn(name: 'text')
            ->dateTimeColumn(name: 'created_at')
            ->dateTimeColumn(name: 'updated_at')
            ->primaryKey('post_id', 'board_id');
    }
}
