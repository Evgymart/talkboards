<?php

declare(strict_types=1);

namespace TalkBoards\Fixtures\Post;

use Symfony\Component\Console\Input\InputInterface;
use TalkBoards\Infrastructure\PostgresThesis\PostgresConnection;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleCommand;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\Output;
use Thesis\StatementContext\Tsx;

final class PostFixtures extends ConsoleCommand
{
    public function __construct(
        private readonly PostgresConnection $connection,
        ?string $name = null,
    ) {
        parent::__construct($name);
    }

    protected static function name(): string
    {
        return 'fixtures:post';
    }

    protected function doExecute(InputInterface $input, Output $output): int
    {
        foreach (PostData::get() as $post) {
            $this->connection->execute(
                static fn(Tsx $tsx): string => <<<SQL
                        insert into board.post(post_id, board_id, user_id, title, text, created_at, updated_at)
                        values (
                            {$tsx($post->postId)},
                            {$tsx($post->boardId)},
                            {$tsx($post->userId)},
                            {$tsx($post->title)},
                            {$tsx($post->text)},
                            {$tsx($post->createdAt->format('Y-m-d H:i:sP'))},
                            {$tsx($post->updatedAt->format('Y-m-d H:i:sP'))}
                        )
                    SQL,
            );
        }

        return self::SUCCESS;
    }
}
