<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

use Contentful\Core\Resource\EntryInterface;

class EmbeddedEntryInline extends InlineNode
{
    /**
     * @var EntryInterface
     */
    protected $entry;

    /**
     * EmbeddedEntryInline constructor.
     *
     * @param NodeInterface[] $content
     */
    public function __construct(array $content, EntryInterface $entry)
    {
        parent::__construct($content);
        $this->entry = $entry;
    }

    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }

    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'embedded-entry-inline';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'data' => [
                'target' => $this->entry->asLink(),
            ],
            'content' => $this->content,
        ];
    }
}
