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

class EntryHyperlink extends InlineNode
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var EntryReferenceInterface
     */
    protected $reference;

    /**
     * AssetHyperlink constructor.
     *
     * @param NodeInterface[] $content
     */
    public function __construct(array $content, EntryReferenceInterface $reference, string $title)
    {
        parent::__construct($content);
        $this->title = $title;
        $this->reference = $reference;
    }

    public function getEntry(): EntryInterface
    {
        return $this->reference->getEntry();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public static function getType(): string
    {
        return 'entry-hyperlink';
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'data' => [
                'title' => $this->title,
                'target' => $this->reference,
            ],
            'content' => $this->content,
        ];
    }
}
