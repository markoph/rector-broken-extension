<?php
declare(strict_types=1);

namespace Example\Utils\Rector\UpgradeToV1;

use PHPStan\Type\ObjectType;
use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

final class ExampleRuleRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        $parentNode = $node->getAttribute(AttributeKey::PARENT_NODE);
        if (!$parentNode) {
            return null;
        }

        if (!$this->isNames($node->name, ['methodName'])) {
            return null;
        }

        // do something

        return $node;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change signature of method',
            [
                new CodeSample(
                    // code before
                    '
                    public function methodName()
                    {
                    }
                    ',
                    // code after
                    '
                    public function methodName()
                    {
                    }
                    '
                ),
            ]
        );
    }
}
