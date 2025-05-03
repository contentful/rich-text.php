<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\Core\File\FileInterface;
use Contentful\Core\File\ImageFile;
use Contentful\Core\Resource\AssetInterface;
use Contentful\RichText\Node\EmbeddedAssetBlock;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

class EmbeddedImage implements NodeRendererInterface
{
    public function supports(NodeInterface $node): bool
    {
        if ($node instanceof EmbeddedAssetBlock) {
            /** @var EmbeddedAssetBlock $asset */
            $asset = $node->getAsset();

            // Checking whether the methods exist is not the most beautiful option.
            // However, this is necessary because the AssetInterface does not contain
            // the getFile method and introducing it would break backwards
            // compatibility. The client libraries implement these methods on the
            // relevant classes, though.
            if (!method_exists($asset, 'getFile') || !method_exists($asset, 'getTitle')) {
                return false;
            }

            /** @var FileInterface $file */
            $file = $asset->getFile();
            $contentType = $file->getContentType();

            return 'image/' === mb_substr($contentType, 0, 6) && $file instanceof ImageFile;
        }

        return false;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        // we verified that these "casts" succeeds above
        /** @var EmbeddedAssetBlock $embeddedAssetBlock */
        $embeddedAssetBlock = $node;
        $asset = $embeddedAssetBlock->getAsset();
        /** @var ImageFile $file */
        $file = $asset->getFile(); // @phpstan-ignore-line

        return $this->renderImage($asset, $file);
    }

    /**
     * This method takes an embedded image and outputs the HTML code to embed it. If you need to implement a custom
     * image renderer, override this method.
     *
     * @param AssetInterface $asset The asset itself. Must implement the getTitle-method. If the method is called
     *                              by the correct class method, this will be verified above.
     * @param ImageFile      $image The image file contained in the asset
     *
     * @return string a HTML string representing the image
     */
    protected function renderImage(AssetInterface $asset, ImageFile $image): string
    {
        // we know this method exists (we checked above), but PHPStan doesn't. So we
        // need to tell it to ignore this call.
        $title = $asset->getTitle(); // @phpstan-ignore-line

        return '<img src="'.$image->getUrl().'" alt="'.htmlspecialchars($title, \ENT_QUOTES).'">';
    }
}
