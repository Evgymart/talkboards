<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\DependencyInjection;

use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\Configurator\InlineServiceConfigurator;

/**
 * @param ?class-string $class
 * @param list<TaggedIteratorArgument> $args
 */
function inlineService(?string $class = null, array $args = []): InlineServiceConfigurator
{
    return (new InlineServiceConfigurator(new Definition($class)))
        ->args($args)
        ->autowire();
}
