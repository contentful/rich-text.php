<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Implementation;

use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\RendererInterface;

/**
 * Basic implementation of RendererInterface for testing purposes.
 */
class Renderer implements RendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function render(NodeInterface $node, array $context = []): string
    {
        if ($node instanceof Node) {
            return $node->getValue();
        }

        return $node->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function renderCollection(array $nodes, array $context = []): string
    {
        return \implode('-', \array_map(function (NodeInterface $node) use ($context): string {
            return $this->render($node, $context);
        }, $nodes));
    }
}
