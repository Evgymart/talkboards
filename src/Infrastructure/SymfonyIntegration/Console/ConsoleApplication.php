<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyIntegration\Console;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;

final class ConsoleApplication extends Application
{
    public function __construct(
        KernelInterface $kernel,
    ) {
        parent::__construct($kernel);
    }
}
