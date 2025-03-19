<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\PostgresThesis\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\DependencyInjection\Reference;
use Thesis\StatementContext\ValueResolver;
use Thesis\StatementContext\ValueResolverRegistry\ContainerValueResolverRegistry;

final class AddValueResolverCompilerPass implements CompilerPassInterface
{
    #[\Override]
    public function process(ContainerBuilder $container): void
    {
        try {
            $registry = $container->findDefinition(ContainerValueResolverRegistry::class);
        } catch (ServiceNotFoundException) {
            return;
        }

        $references = [];

        foreach (array_keys($container->findTaggedServiceIds(ValueResolver::class)) as $serviceId) {
            $class = $container->findDefinition($serviceId)->getClass();
            \assert($class !== null);
            \assert(is_a($class, ValueResolver::class, true));

            foreach ($class::valueTypes() as $valueType) {
                $references[$valueType] = new Reference($serviceId);
            }
        }

        $registry->setArgument(0, ServiceLocatorTagPass::register($container, $references));
    }
}
