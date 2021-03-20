<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

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
