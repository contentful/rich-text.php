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

class EntryHyperlink implements NodeInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var ResourceInterface
     */
    private $resource;

    /**
     * EntryHyperlink constructor.
     *
     * @param string            $title
     * @param ResourceInterface $resource
     */
    public function __construct(string $title, ResourceInterface $resource)
    {
        $this->title = $title;
        $this->resource = $resource;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
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
                'target' => $this->resource->asLink(),
            ],
        ];
    }
}
