<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

class CatchAll implements NodeRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(NodeInterface $node): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        return '';
    }
}
