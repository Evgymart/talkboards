<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

final readonly class PostgresConnection
{
    public function __construct(
        private ConnectionWrapper $wrapper,
        private Mapper $mapper,
    ) {}

    /**
     * @template T of object
     * @param non-empty-string $sql
     * @param array<non-empty-string, non-empty-string> $params
     * @param null|class-string<T> $type
     * @return ($type is null ? array<non-empty-string, non-empty-string> : T)
     * @throws DatabaseException
     */
    public function execute(string $sql, array $params = [], ?string $type = null): null|array|object
    {
        try {
            $connection = $this->wrapper->getConnection();
            // TODO: Make sure this works
            /** @var array<non-empty-string, non-empty-string> $data */
            $data = $connection->prepare($sql)
                 ->executeQuery($params)
                 ->fetchAssociative();

            if ($type === null) {
                return $data;
            }
        } catch (\Throwable $e) {
            throw new DatabaseException(\sprintf(
                "Unable to execute query: %s\nQuery: %s\nParams: %s",
                $e->getMessage(),
                $sql,
                json_encode($params, JSON_PRETTY_PRINT),
            ));
        }

        return $this->mapper->map($type, $data);
    }
}
