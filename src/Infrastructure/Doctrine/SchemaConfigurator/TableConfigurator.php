<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Doctrine\SchemaConfigurator;

use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Types;
use TalkBoards\Infrastructure\Doctrine\Type\DateMilliTimeZoneImmutableType;

final readonly class TableConfigurator
{
    public function __construct(
        private Table $table,
    ) {}

    /**
     * @deprecated используем обычный тип + generated always as identity на уровне миграции
     */
    public function serialColumn(string $name): self
    {
        $this->table->addColumn($name, Types::INTEGER)->setAutoincrement(true);

        return $this;
    }

    /**
     * @no-named-arguments
     */
    public function primaryKey(string $column, string ...$columns): self
    {
        $this->table->setPrimaryKey([$column, ...$columns]);

        return $this;
    }

    /**
     * @param non-empty-list<string> $localColumns
     * @param non-empty-list<string> $foreignColumns
     */
    public function foreignKey(
        string $foreignTable,
        array $localColumns,
        array $foreignColumns,
        Deferral $deferral = Deferral::NOT_DEFERRABLE,
        ReferentialAction $onUpdate = ReferentialAction::NO_ACTION,
        ReferentialAction $onDelete = ReferentialAction::NO_ACTION,
    ): self {
        $this->table->addForeignKeyConstraint($foreignTable, $localColumns, $foreignColumns, [
            'deferrable' => $deferral !== Deferral::NOT_DEFERRABLE,
            'feferred' => $deferral === Deferral::DEFERRABLE_INITIALLY_DEFERRED,
            'onUpdate' => $onDelete->value,
            'onDelete' => $onUpdate->value,
        ]);

        return $this;
    }

    /**
     * @no-named-arguments
     */
    public function index(string $column, string ...$columns): self
    {
        $this->table->addIndex([$column, ...$columns]);

        return $this;
    }

    /**
     * @no-named-arguments
     */
    public function partialIndex(string $condition, string $column, string ...$columns): self
    {
        $this->table->addIndex([$column, ...$columns], null, [], ['where' => \sprintf('(%s)', $condition)]);

        return $this;
    }

    /**
     * @no-named-arguments
     */
    public function uniqueIndex(string $column, string ...$columns): self
    {
        $this->table->addUniqueIndex([$column, ...$columns]);

        return $this;
    }

    /**
     * @no-named-arguments
     */
    public function namedUniqueIndex(string $name, string $column, string ...$columns): self
    {
        $this->table->addUniqueIndex([$column, ...$columns], $name);

        return $this;
    }

    public function smallIntColumn(string $name, bool $nullable = false, ?int $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::SMALLINT)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function intColumn(string $name, bool $nullable = false, bool $unsigned = false, ?int $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::INTEGER)
            ->setUnsigned($unsigned)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    /**
     * @param ?numeric-string $default
     */
    public function bigintColumn(string $name, bool $nullable = false, ?string $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::BIGINT)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function decimalColumn(string $name, int $precision = 10, int $scale = 5, bool $nullable = false, ?int $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::DECIMAL)
            ->setPrecision($precision)
            ->setScale($scale)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function floatColumn(string $name, bool $nullable = false, ?int $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::FLOAT)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function stringColumn(string $name, bool $nullable = false, ?string $default = null, ?int $length = null, bool $fixed = false, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::STRING)
            ->setNotnull(!$nullable)
            ->setLength($length)
            ->setDefault($default)
            ->setFixed($fixed)
            ->setComment($comment);

        return $this;
    }

    public function textColumn(string $name, bool $nullable = false, ?string $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::TEXT)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function boolColumn(string $name, bool $nullable = false, ?bool $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::BOOLEAN)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function uuidColumn(string $name, bool $nullable = false, ?string $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::GUID)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function jsonColumn(string $name, bool $nullable = false, mixed $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::JSON)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function jsonbColumn(string $name, bool $nullable = false, mixed $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::JSON)
            ->setNotnull(!$nullable)
            ->setPlatformOption('jsonb', true)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function dateTimeColumn(string $name, bool $nullable = false, mixed $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::DATETIMETZ_IMMUTABLE)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function dateTimeMsColumn(string $name, bool $nullable = false, mixed $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, DateMilliTimeZoneImmutableType::name())
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function dateColumn(string $name, bool $nullable = false, mixed $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::DATE_IMMUTABLE)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function timeColumn(string $name, bool $nullable = false, mixed $default = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::TIME_IMMUTABLE)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }

    public function blobColumn(string $name, bool $nullable = false, mixed $default = null, ?int $length = null, ?string $comment = null): self
    {
        $this
            ->table
            ->addColumn($name, Types::BLOB)
            ->setLength($length)
            ->setNotnull(!$nullable)
            ->setDefault($default)
            ->setComment($comment);

        return $this;
    }
}
