<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyIntegration\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class ConsoleCommand extends Command
{
    /**
     * @return non-empty-string
     */
    final public static function getDefaultName(): string
    {
        return static::name();
    }

    /**
     * @return non-empty-string
     */
    abstract protected static function name(): string;

    final protected function execute(InputInterface $input, OutputInterface $output): int
    {
        \assert($output instanceof ConsoleOutputInterface);

        return $this->doExecute($input, new Output($input, $output));
    }

    final protected function interact(InputInterface $input, OutputInterface $output): void
    {
        \assert($output instanceof ConsoleOutputInterface);

        $this->doInteract($input, new Output($input, $output));
    }

    protected function doInteract(InputInterface $input, Output $output): void {}

    abstract protected function doExecute(InputInterface $input, Output $output): int;
}
