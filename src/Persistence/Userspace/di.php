<?php

declare(strict_types=1);

namespace TalkBoards\Persistence\Userspace;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use TalkBoards\Infrastructure\DependencyInjection\Module;

return static function (ContainerConfigurator $di): void {
    Module::create($di)
        ->set(UserSchema::class);
};
