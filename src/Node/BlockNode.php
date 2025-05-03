<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

abstract class BlockNode implements NodeInterface
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
