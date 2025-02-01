<?php

declare(strict_types=1);

namespace TalkBoards\Presentation\Console\HelloWorld;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use TalkBoards\Feature\Demo\HelloWorld\HelloWorld;
use TalkBoards\Infrastructure\MessageBus\MessageBus;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\ConsoleCommand;
use TalkBoards\Infrastructure\SymfonyIntegration\Console\Output;

final class HelloCommand extends ConsoleCommand
{
    public function __construct(
        private readonly MessageBus $messageBus,
    ) {
        parent::__construct(self::name());
    }

    protected static function name(): string
    {
        return 'hello-world';
    }

    protected function configure(): void
    {
        $this
            ->addArgument('param', mode: InputOption::VALUE_OPTIONAL);
    }

    protected function doExecute(InputInterface $input, Output $output): int
    {
        $result = [
            'message' => 'Hello World!',
        ];

        $param = ((array) $input->getArgument('param'))[0] ?? null;
        if (\is_string($param)) {
            $result['param'] = $this->messageBus->execute(new HelloWorld($param));
        }

        $output->writeln(jsonEncode($result));

        return self::SUCCESS;
    }
}
