<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

abstract class InlineNode implements NodeInterface
{
    /**
     * @var NodeInterface[]
     */
    protected $content;

    /**
     * BlockNode constructor.
     *
     * @param NodeInterface[] $content
     */
    public function __construct(array $content)
    {
        foreach ($content as $node) {
            if ($node instanceof BlockNode) {
                throw new \InvalidArgumentException(\sprintf('Node of class "%s" can not be set as child of class "%s", as it can not contain block nodes.', $node::class, static::class));
            }
        }

        $this->content = $content;
    }

    /**
     * @return NodeInterface[]
     */
    public function getContent(): array
    {
        return $this->content;
    }
}
