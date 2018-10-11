<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
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
     * @param string          $uri
     * @param string          $title
     */
    public function __construct(array $content, string $uri, string $title)
    {
        parent::__construct($content);
        $this->uri = $uri;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
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
        return 'hyperlink';
    }

    /**
     * {@inheritdoc}
     */
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
