<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper\Reference;

use Contentful\Core\Api\Link;
use Contentful\Core\Resource\EntryInterface;

class StaticEntryReference implements EntryReferenceInterface
{
    /**
     * @var EntryInterface
     */
    private $entry;

    /**
     * StaticEntryReference constructor.
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

    public function jsonSerialize(): mixed
    {
        return $this->entry->asLink()->jsonSerialize();
    }
}
