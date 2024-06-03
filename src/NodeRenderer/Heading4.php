<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\Heading4 as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

class Heading4 implements NodeRendererInterface
{
    public function supports(NodeInterface $node): bool
    {
        return $node instanceof NodeClass;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        /* @var NodeClass $node */
        if (!$node instanceof NodeClass) {
            throw new \LogicException(sprintf('Trying to use node renderer "%s" to render unsupported node of class "%s".', static::class, $node::class));
        }

        return '<h4>'.$renderer->renderCollection($node->getContent(), $context).'</h4>';
    }
}
