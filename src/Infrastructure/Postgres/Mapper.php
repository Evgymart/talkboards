<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\Postgres;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\Mapper\TreeMapper;
use CuyZ\Valinor\MapperBuilder;
use TalkBoards\Infrastructure\Uuid\Uuid;

final readonly class Mapper
{
    private TreeMapper $mapper;

    public function __construct()
    {
        $this->mapper = (new MapperBuilder())
            ->registerConstructor(Uuid::class, Uuid::fromString(...))
            ->supportDateFormats('Y-m-d H:i:s+P')
            ->mapper();
    }

    /**
     * @template T of object
     * @param class-string<T> $type
     * @param array<non-empty-string, non-empty-string> $data
     * @return T
     */
    public function map(string $type, array $data): object
    {
        try {
            $source = Source::array($data)->camelCaseKeys();
            $mapped = $this->mapper->map($type, $source);
            if ($mapped instanceof $type) {
                return $mapped;
            }
        } catch (MappingError) {
        }

        throw new \LogicException(\sprintf('Could not properly map the object to %s', $type));
    }
}
