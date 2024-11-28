<?php

declare(strict_types=1);

namespace TalkBoards\Infrastructure\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\Empty_;
use PhpParser\Node\Expr\Exit_;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule as PHPStanRule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;

/**
 * @implements PHPStanRule<Node>
 */
final readonly class ForbiddenFunctions implements PHPStanRule
{
    public function getNodeType(): string
    {
        return Node::class;
    }

    /**
     * @throws ShouldNotHappenException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node instanceof FuncCall) {
            $functionName = $node->name instanceof Node\Name
                ? $node->name->toString()
                : null;

            if (\in_array($functionName, self::bannedFunctions(), true)) {
                return [
                    RuleErrorBuilder::message(
                        \sprintf('The use of function "%s" is banned.', $functionName),
                    )->identifier('rules.ForbiddenFunctions')
                        ->build(),
                ];
            }
        }

        if ($node instanceof Empty_) {
            return [
                RuleErrorBuilder::message('The use of "empty" is banned.')
                    ->identifier('custom.bannedEmpty')
                    ->build(),
            ];
        }

        if ($node instanceof Exit_) {
            return [
                RuleErrorBuilder::message('The use of "die" or "exit" is banned.')
                    ->identifier('custom.bannedExit')
                    ->build(),
            ];
        }

        return [];
    }

    /**
     * @return list<string>
     */
    private static function bannedFunctions(): array
    {
        return [
            'print_r',
            'var_dump',
            'eval',
        ];
    }
}
