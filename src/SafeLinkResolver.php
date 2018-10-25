<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\ResourceInterface;
use Contentful\RichText\Resource\Asset;
use Contentful\RichText\Resource\Entry;

/**
 * SafeLinkResolver class.
 *
 * This class wraps a proper link resolver to provide a fallback in the event
 * of an invalid link resolution, for instance when trying to resolve a link
 * to a non-published resource in the Delivery API.
 */
class SafeLinkResolver implements LinkResolverInterface
{
    /**
     * @var LinkResolverInterface
     */
    private $linkResolver;

    /**
     * SafeLinkResolver constructor.
     *
     * @param LinkResolverInterface $linkResolver
     */
    public function __construct(LinkResolverInterface $linkResolver)
    {
        $this->linkResolver = $linkResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function resolveLink(Link $link, array $parameters = []): ResourceInterface
    {
        try {
            return $this->linkResolver->resolveLink($link, $parameters);
        } catch (\Exception $exception) {
        }

        return 'Entry' === $link->getLinkType()
            ? new Entry($link->getId())
            : new Asset($link->getId());
    }
}
