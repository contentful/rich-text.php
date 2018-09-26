<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Node;

abstract class InlineNode implements NodeInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNodeClass(): string
    {
        return 'inline';
    }
}
