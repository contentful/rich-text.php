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

class EntryHyperlink extends InlineNode
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var EntryInterface
     */
    protected $entry;

    /**
     * AssetHyperlink constructor.
     *
     * @param NodeInterface[] $content
     * @param EntryInterface  $entry
     * @param string          $title
     */
    public function __construct(array $content, EntryInterface $entry, string $title)
    {
        parent::__construct($content);
        $this->entry = $entry;
        $this->title = $title;
    }

    /**
     * @return EntryInterface
     */
    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'entry-hyperlink';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'data' => [
                'title' => $this->title,
                'target' => $this->entry->asLink(),
            ],
            'content' => $this->content,
        ];
    }
}
