<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Node;

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

    /**
     * {@inheritdoc}
     */
    public function getNodeClass(): string
    {
        return 'block';
    }
}
