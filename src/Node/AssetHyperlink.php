<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Node;

use Contentful\Core\Resource\ResourceInterface;

class AssetHyperlink extends InlineNode
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var ResourceInterface
     */
    protected $resource;

    /**
     * AssetHyperlink constructor.
     *
     * @param NodeInterface[]   $content
     * @param ResourceInterface $resource
     * @param string            $title
     */
    public function __construct(array $content, ResourceInterface $resource, string $title)
    {
        parent::__construct($content);
        $this->resource = $resource;
        $this->title = $title;
    }

    /**
     * @return ResourceInterface
     */
    public function getResource(): ResourceInterface
    {
        return $this->resource;
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
        return 'asset-hyperlink';
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
                'target' => $this->resource->asLink(),
            ],
            'content' => $this->content,
        ];
    }
}
