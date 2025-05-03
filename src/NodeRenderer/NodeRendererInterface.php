<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

/**
 * NodeRendererInterface.
 *
 * A class implementing this interface is responsible for
 * turning a limited subset of objects implementing NodeInterface
 * into a string.
 *
 * The node renderer makes the support for a certain node explicit by
 * implementing the "supports" method.
 *
 * The node renderer can also throw an exception during rendering if
 * the given node is not supported.
 */
interface NodeRendererInterface
{
    /**
     * Returns whether the current renderer
     * supports rendering the given node.
     *
     * @param NodeInterface $node The node which will be tested
     */
    public function supports(NodeInterface $node): bool;

    /**
     * Renders a node into a string.
     *
     * @param RendererInterface $renderer The generic renderer object, which is used for
     *                                    delegating rendering of nested nodes (such as ListItem in lists)
     * @param NodeInterface     $node     The node which must be rendered
     * @param array             $context  Optionally, extra context variables (useful with custom node renderers)
     *
     * @throws \InvalidArgumentException when the given $node is not supported
     */
    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string;
}
