<?php

declare(strict_types=1);

use TalkBoards\Infrastructure\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return static fn(array $context) => new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
