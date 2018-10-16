<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\AssetHyperlink;
use Contentful\Tests\RichText\Implementation\Asset;
use Contentful\Tests\RichText\TestCase;

class AssetHyperlinkTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('asset-hyperlink', AssetHyperlink::getType());

        $nodes = $this->createNodes(1);
        $asset = new Asset('assetId');
        $node = new AssetHyperlink($nodes, $asset, 'Asset link');

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($asset, $node->getAsset());
        $this->assertSame('Asset link', $node->getTitle());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
