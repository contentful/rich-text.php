<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper\Reference;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\ResourceInterface;
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
     * @var ResourceInterface|null
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

        $this->entry = null;
        $this->link = $link;
        $this->linkResolver = $linkResolver;
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function getEntry(): ResourceInterface
    {
        if (null === $this->entry) {
            $this->entry = $this->linkResolver->resolveLink($this->link);
        }

        return $this->entry;
    }

    public function jsonSerialize()
    {
        return $this->link->jsonSerialize();
    }
}
