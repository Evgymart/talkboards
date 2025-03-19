<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\PostgresThesis;

use Thesis\Postgres\PostgresConnection as ThesisPostgresConnection;
use Thesis\Postgres\PostgresDsn;
use Thesis\Postgres\PostgresPdoDriver;
use Thesis\Result\Hydrator;
use Thesis\Result\Result as ThesisResult;
use Thesis\StatementContext\Tsx;
use Thesis\StatementContext\ValueResolverRegistry;
use Thesis\StatementExecutor\StatementExecutionException;
use Thesis\Transaction\TransactionIsolationLevels;

/**
 * @psalm-import-type Statement from Tsx
 */
final readonly class PostgresConnection
{
    private const int DEFAULT_CURSOR_LIMIT = 1000;

    private ThesisPostgresConnection $connection;

    public function __construct(
        string $host,
        int $port,
        string $user,
        string $password,
        string $dbName,
        ValueResolverRegistry $valueResolverRegistry,
        Hydrator $hydrator,
    ) {
        $driver = new PostgresPdoDriver(valueResolverRegistry: $valueResolverRegistry, hydrator: $hydrator);

        $this->connection = $driver->connect(
            new PostgresDsn(
                host: $host,
                port: $port,
                user: $user,
                password: $password,
                databaseName: $dbName,
            ),
        );
    }

    /**
     * @param Statement $statement
     * @return Result<int, array<array-key, mixed>>
     * @throws StatementExecutionException
     */
    public function execute(string|\Generator|callable $statement): Result
    {
        /** @var ThesisResult<int, array<array-key, mixed>> $thesisResult */
        $thesisResult = $this->connection->execute($statement);

        return Result::fromThesisResult($thesisResult);
    }

    /**
     * @param Statement $statement
     * @return Result<int, array<array-key, mixed>>
     * @throws StatementExecutionException
     */
    public function cursor(string|\Generator|callable $statement, int $limit = self::DEFAULT_CURSOR_LIMIT): Result
    {
        /** @var ThesisResult<int, array<array-key, mixed>> $thesisResult */
        $thesisResult = $this->connection->cursor($statement, $limit);

        return Result::fromThesisResult($thesisResult);
    }

    /**
     * @template T of mixed|void
     * @param callable(): T $operation
     * @param ?TransactionIsolationLevels::* $isolationLevel
     * @return T
     */
    public function transactionally(callable $operation, ?string $isolationLevel = null)
    {
        return $this->connection->transactionally($operation, $isolationLevel);
    }
}
