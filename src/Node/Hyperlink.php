<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class Hyperlink extends InlineNode
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $title;

    /**
     * Hyperlink constructor.
     *
     * @param NodeInterface[] $content
     */
    public function __construct(array $content, string $uri, string $title)
    {
        parent::__construct($content);
        $this->uri = $uri;
        $this->title = $title;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public static function getType(): string
    {
        return 'hyperlink';
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'data' => [
                'uri' => $this->uri,
                'title' => $this->title,
            ],
            'content' => $this->content,
        ];
    }
}
