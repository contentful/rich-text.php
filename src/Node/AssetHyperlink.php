<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

use Contentful\Core\Resource\AssetInterface;

class AssetHyperlink extends InlineNode
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var AssetInterface
     */
    protected $asset;

    /**
     * AssetHyperlink constructor.
     *
     * @param NodeInterface[] $content
     */
    public function __construct(array $content, AssetInterface $asset, string $title)
    {
        parent::__construct($content);
        $this->asset = $asset;
        $this->title = $title;
    }

    public function getAsset(): AssetInterface
    {
        return $this->asset;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public static function getType(): string
    {
        return 'asset-hyperlink';
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'data' => [
                'title' => $this->title,
                'target' => $this->asset->asLink(),
            ],
            'content' => $this->content,
        ];
    }
}
