<?php
namespace Contentful\RichText\NodeMapper\Reference;

use Contentful\Core\Api\Link;
use Contentful\Core\Resource\EntryInterface;

class StaticEntryReference implements EntryReferenceInterface
{
    /** @var EntryInterface */
    private $entry;

    /**
     * StaticEntryReference constructor.
     *
     * @param EntryInterface $entry
     */
    public function __construct(EntryInterface $entry)
    {
        $this->entry = $entry;
    }

    public function getLink(): Link
    {
        return $this->entry->asLink();
    }

    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }

    public function jsonSerialize()
    {
        return $this->entry->asLink()->jsonSerialize();
    }
}
