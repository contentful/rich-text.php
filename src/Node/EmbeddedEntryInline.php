<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

use Contentful\Core\Resource\EntryInterface;
use Contentful\RichText\NodeMapper\Reference\EntryReferenceInterface;

class EmbeddedEntryInline extends InlineNode
{
    /**
     * @var EntryReferenceInterface
     */
    protected $reference;

    /**
     * EmbeddedEntryInline constructor.
     *
     * @param NodeInterface[] $content
     */
    public function __construct(array $content, EntryReferenceInterface $reference)
    {
        parent::__construct($content);
        $this->reference = $reference;
    }

    public function getEntry(): EntryInterface
    {
        return $this->reference->getEntry();
    }

    public static function getType(): string
    {
        return 'embedded-entry-inline';
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'data' => [
                'target' => $this->reference,
            ],
            'content' => $this->content,
        ];
    }
}
