<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper\Reference;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\EntryInterface;
use InvalidArgumentException;

class EntryReference implements EntryReferenceInterface
{
    /**
     * @var Link
     */
    private $link;

    /**
     * @var LinkResolverInterface
     */
    private $linkResolver;

    /**
     * @var EntryInterface|null
     */
    private $entry;

    /**
     * EntryReference constructor.
     */
    public function __construct(Link $link, LinkResolverInterface $linkResolver)
    {
        if ('Entry' !== $link->getLinkType()) {
            throw new InvalidArgumentException('Link is required to reference an Entry.');
        }

        $this->link = $link;
        $this->linkResolver = $linkResolver;
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function getEntry(): EntryInterface
    {
        if (null === $this->entry) {
            $resource = $this->linkResolver->resolveLink($this->link);

            if ($resource instanceof EntryInterface) {
                return $this->entry = $resource;
            }

            // @codeCoverageIgnoreStart
            throw new \RuntimeException(\sprintf('A link has been resolved to an instance of %s, but %s is expected. This should never happen.', \get_class($resource), EntryInterface::class));
            // @codeCoverageIgnoreEnd
        }

        return $this->entry;
    }

    /**
     * @return array[]|mixed
     */
    public function jsonSerialize()
    {
        return $this->link->jsonSerialize();
    }
}
