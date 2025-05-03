<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\AssetHyperlink as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

class AssetHyperlink implements NodeRendererInterface
{
    public function supports(NodeInterface $node): bool
    {
        return $node instanceof NodeClass;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        /* @var NodeClass $node */
        if (!$node instanceof NodeClass) {
            throw new \LogicException(\sprintf('Trying to use node renderer "%s" to render unsupported node of class "%s".', static::class, $node::class));
        }

        return \sprintf(
            '<a href="#Asset-%s" title="%s">%s</a>',
            $node->getAsset()->getId(),
            $node->getTitle(),
            $renderer->renderCollection($node->getContent(), $context)
        );
    }
}
