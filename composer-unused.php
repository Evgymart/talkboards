<?php

declare(strict_types=1);

use ComposerUnused\ComposerUnused\Configuration\Configuration;
use ComposerUnused\ComposerUnused\Configuration\NamedFilter;

return static fn(Configuration $config): Configuration => $config
    ->addNamedFilter(NamedFilter::fromString('baldinof/roadrunner-bundle'))
    ->addNamedFilter(NamedFilter::fromString('symfony/dotenv'))
    ->addNamedFilter(NamedFilter::fromString('symfony/flex'))
    ->addNamedFilter(NamedFilter::fromString('symfony/runtime'))
    ->addNamedFilter(NamedFilter::fromString('symfony/yaml'))
    ->addNamedFilter(NamedFilter::fromString('phpdocumentor/reflection-docblock'))
    ->addNamedFilter(NamedFilter::fromString('phpstan/phpdoc-parser'))
    ->addNamedFilter(NamedFilter::fromString('symfony/property-access'))
    ->addNamedFilter(NamedFilter::fromString('symfony/property-info'))
    ->addNamedFilter(NamedFilter::fromString('doctrine/doctrine-bundle'))
    ->addNamedFilter(NamedFilter::fromString('doctrine/doctrine-migrations-bundle'));
