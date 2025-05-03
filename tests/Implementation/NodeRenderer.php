<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\NodeRenderer\NodeRendererInterface;
use Contentful\RichText\RendererInterface;

/**
 * Basic implementation of NodeRendererInterface for testing purposes.
 */
class NodeRenderer implements NodeRendererInterface
{
    public function supports(NodeInterface $node): bool
    {
        return true;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        if ($node instanceof Node) {
            return $node->getValue();
        }

        return 'hello';
    }
}
