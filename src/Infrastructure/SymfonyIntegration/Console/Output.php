<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyIntegration\Console;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\ConsoleSectionOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\VarDumper\VarDumper;

final readonly class Output
{
    private ConsoleOutputInterface $output;

    private SymfonyStyle $io;

    public function __construct(
        InputInterface $input,
        OutputInterface $output,
    ) {
        \assert($output instanceof ConsoleOutputInterface);
        $this->output = $output;
        $this->io = new SymfonyStyle($input, $output);
    }

    public function newLine(int $count = 1): void
    {
        $this->io->newLine($count);
    }

    /**
     * @param string|array<string> $messages
     */
    public function writeln(string|array $messages): void
    {
        $this->io->writeln($messages);
    }

    public function json(mixed $value): void
    {
        $this->io->writeln(jsonEncode($value));
    }

    public function title(string $message): void
    {
        $this->io->title($message);
    }

    public function section(): ConsoleSectionOutput
    {
        return $this->output->section();
    }

    /**
     * @param string|array<string> $message
     */
    public function text(string|array $message): void
    {
        $this->io->text($message);
    }

    /**
     * @param string|array<string> $message
     */
    public function comment(string|array $message): void
    {
        $this->io->comment($message);
    }

    /**
     * @param string|array<string> $message
     */
    public function success(string|array $message): void
    {
        $this->io->success($message);
    }

    /**
     * @param string|array<string> $message
     */
    public function error(string|array $message): void
    {
        $this->io->error($message);
    }

    /**
     * @param string|array<string> $message
     */
    public function warning(string|array $message): void
    {
        $this->io->warning($message);
    }

    /**
     * @param string|array<string> $message
     */
    public function note(string|array $message): void
    {
        $this->io->note($message);
    }

    public function isQuiet(): bool
    {
        return $this->io->isQuiet();
    }

    /**
     * @param string|array<string> $message
     */
    public function info(string|array $message): void
    {
        $this->io->info($message);
    }

    /**
     * @param array<string> $headers
     * @param iterable<array<string>|TableSeparator> $rows
     */
    public function table(array $headers, iterable $rows = []): Table
    {
        $table = new Table($this->io);
        $table->setHeaders($headers);

        foreach ($rows as $row) {
            $table->addRow($row);
        }

        $table->render();

        return $table;
    }

    public function ask(string $question, ?string $default = null, ?callable $validator = null): mixed
    {
        return $this->io->ask($question, $default, $validator);
    }

    public function confirm(string $question, bool $default = true): bool
    {
        return $this->io->confirm($question, $default);
    }

    public function dump(mixed ...$values): void
    {
        if ($this->isQuiet()) {
            return;
        }

        foreach ($values as $value) {
            VarDumper::dump($value);
        }
    }
}
