<?php

declare(strict_types=1);

namespace TalkBoards\Application\Board\Search\Handlers;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use TalkBoards\Application\Board\AddBoard;
use TalkBoards\Application\Board\Board;
use TalkBoards\Application\Board\Handlers\AddBoardHandler;
use TalkBoards\Application\Board\Handlers\SearchBoardHandler;
use TalkBoards\Application\Board\SearchBoard;
use TalkBoards\Infrastructure\Uuid\Uuid;
use TalkBoards\Persistence\Board\BoardSchema;
use TalkBoards\Tools\IntegrationTestCase;
use TalkBoards\Tools\TestApp;
use function PHPUnit\Framework\assertEquals;

#[CoversClass(AddBoardHandler::class)]
#[CoversClass(SearchBoardHandler::class)]
#[Group('integration')]
final class SearchBoardHandlerTest extends IntegrationTestCase
{
    protected function schema(): array
    {
        return [
            BoardSchema::class,
        ];
    }

    public function testBasic(): void
    {
        $boardId = Uuid::fromString('14cc5471-ddda-461a-862a-98da8907abed');
        $name = 'name';
        $description = 'description';
        $createdAt = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2025-05-01 12:00:00');
        \assert($createdAt instanceof \DateTimeImmutable);
        $connection = TestApp::testThesisConnection();
        $addHandler = new AddBoardHandler($connection);
        $addHandler(new AddBoard($boardId, $name, $description, $createdAt));

        $searchHandler = new SearchBoardHandler($connection);
        $result = $searchHandler(new SearchBoard(
            'description',
        ));

        $expected = [new Board($boardId, $name, $description, $createdAt)];
        assertEquals($expected, $result);
    }
}
