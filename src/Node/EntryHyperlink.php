<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
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
     * @var \Contentful\Core\Api\Link
     */
    private $link;

    /**
     * @var \Contentful\Core\Api\LinkResolverInterface
     */
    private $linkResolver;

    /**
     * AssetHyperlink constructor.
     *
     * @param NodeInterface[] $content
     * @param string $title
     * @param \Contentful\Core\Api\Link $link
     * @param \Contentful\Core\Api\LinkResolverInterface $linkResolver
     */
    public function __construct(array $content, string $title, Link $link, LinkResolverInterface $linkResolver)
    {
        parent::__construct($content);
        $this->title = $title;
        $this->entry = null;
        $this->link = $link;
        $this->linkResolver = $linkResolver;
    }

    /**
     * @return EntryInterface
     */
    public function getEntry(): EntryInterface
    {
        if (is_null($this->entry)) {
            $this->entry = $this->linkResolver->resolveLink($this->link);
        }
        return $this->entry;
    }

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
                'target' => $this->link,
            ],
            'content' => $this->content,
        ];
    }
}
