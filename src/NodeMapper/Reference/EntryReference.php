<?php
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
     * @var EntryInterface
     */
    private $entry;

    /**
     * EntryReference constructor.
     *
     * @param Link $link
     * @param LinkResolverInterface $linkResolver
     */
    public function __construct(Link $link, LinkResolverInterface $linkResolver)
    {
        if ($link->getLinkType() !== 'Entry') {
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

    public function getEntry(): EntryInterface
    {
        if (is_null($this->entry)) {
            $this->entry = $this->linkResolver->resolveLink($this->link);
        }
        return $this->entry;
    }

    public function jsonSerialize()
    {
        return $this->link->jsonSerialize();
    }
}
