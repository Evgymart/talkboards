<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\SymfonyIntegration\HttpKernel;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final readonly class RemoveLocaleListenersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $container->removeDefinition('locale_listener');
        $container->removeDefinition('locale_aware_listener');
    }
}
