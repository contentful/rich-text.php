<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

use Contentful\Core\Resource\EntryInterface;

class EmbeddedEntryBlock extends BlockNode
{
    /**
     * @var EntryInterface
     */
    protected $entry;

    /**
     * EmbeddedEntryBlock constructor.
     *
     * @param NodeInterface[] $content
     * @param EntryInterface  $entry
     */
    public function __construct(array $content, EntryInterface $entry)
    {
        parent::__construct($content);
        $this->entry = $entry;
    }

    /**
     * @return EntryInterface
     */
    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }

    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'embedded-entry-block';
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
