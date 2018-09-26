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

class EmbeddedEntryBlock extends BlockNode
{
    /**
     * @var ResourceInterface
     */
    protected $resource;

    /**
     * EmbeddedEntryBlock constructor.
     *
     * @param NodeInterface[]   $content
     * @param ResourceInterface $resource
     */
    public function __construct(array $content, ResourceInterface $resource)
    {
        parent::__construct($content);
        $this->resource = $resource;
    }

    /**
     * @return ResourceInterface
     */
    public function getResource(): ResourceInterface
    {
        return $this->resource;
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
                'target' => $this->resource->asLink(),
            ],
            'content' => $this->content,
        ];
    }
}
