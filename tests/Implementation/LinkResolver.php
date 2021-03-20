<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

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
        switch ($link->getLinkType()) {
            case 'Asset':
                return new Asset($link->getId());
            case 'Entry':
                return new Entry($link->getId());
            default:
                return new Resource($link->getId(), $link->getLinkType());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function resolveLinkCollection(array $links, array $parameters = []): array
    {
        return \array_map(function (Link $link) use ($parameters): ResourceInterface {
            return $this->resolveLink($link, $parameters);
        }, $links);
    }
}
