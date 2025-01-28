<?php

declare(strict_types=1);

namespace TalkBoards\Feature\Board;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use TalkBoards\Infrastructure\Uuid\Uuid;
use TalkBoards\Infrastructure\UuidDoctrine\UuidType;

#[Entity]
final readonly class Board
{
    public function __construct(
        #[Column(type: UuidType::class), Id]
        public Uuid $id,
        #[Column(type: UuidType::class)]
        public string $name,
        #[Column]
        public string $description,
        #[Column(type: Types::DATETIMETZ_IMMUTABLE)]
        public \DateTimeImmutable $createdAt,
    ) {}
}
