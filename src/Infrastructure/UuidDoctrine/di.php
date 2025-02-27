<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\UuidDoctrine;

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $di->extension('doctrine', [
        'dbal' => [
            'types' => [
                UuidType::class => UuidType::class,
            ],
        ],
    ]);
};
