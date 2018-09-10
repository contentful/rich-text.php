<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Implementation;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\ResourceInterface;

/**
 * Basic implementation of LinkResolverInterface for testing purposes.
 */
class LinkResolver implements LinkResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolveLink(Link $link, array $parameters = []): ResourceInterface
    {
        return new Resource($link->getId(), $link->getLinkType());
    }
}
