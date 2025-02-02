<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\SchemaConfigurator;

use Doctrine\DBAL\Schema\Schema;

final readonly class SchemaConfigurator
{
    public function __construct(
        private Schema $schema,
    ) {}

    public function table(string $name, ?string $comment = null): TableConfigurator
    {
        $table = $this->schema
            ->createTable($name)
            ->setComment($comment);

        return new TableConfigurator($table);
    }
}
