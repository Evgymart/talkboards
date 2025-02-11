<?php

declare(strict_types=1);

namespace TalkBoards\Persistence\Userspace;

use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaConfigurator;
use TalkBoards\Infrastructure\Doctrine\SchemaConfigurator\SchemaSubscriber;

final readonly class UserSchema implements SchemaSubscriber
{
    public function configureSchema(SchemaConfigurator $schema): void
    {
        $schema
            ->table(name: 'userspace.user')
            ->uuidColumn(name: 'user_id')
            ->dateColumn(name: 'created_at')
            ->primaryKey(column: 'user_id');
    }
}
