<?php

declare(strict_types=1);

namespace TalkBoards\Application\Board;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use TalkBoards\Application\Board\Handlers\SearchBoardHandler;
use TalkBoards\Infrastructure\DependencyInjection\Module;

return static function (ContainerConfigurator $di): void {
    $module = Module::create($di);
    $module->set(SearchBoardHandler::class)
        ->tag('messenger.message_handler');
};
