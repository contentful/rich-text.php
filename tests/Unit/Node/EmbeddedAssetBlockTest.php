<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\EmbeddedAssetBlock;
use Contentful\Tests\RichText\Implementation\Asset;
use Contentful\Tests\RichText\TestCase;

class EmbeddedAssetBlockTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('embedded-asset-block', EmbeddedAssetBlock::getType());

        $nodes = $this->createNodes(5);
        $asset = new Asset('assetId');
        $node = new EmbeddedAssetBlock($nodes, $asset);

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($asset, $node->getAsset());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
