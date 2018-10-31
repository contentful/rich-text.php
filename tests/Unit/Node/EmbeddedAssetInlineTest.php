<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\EmbeddedAssetInline;
use Contentful\Tests\RichText\Implementation\Asset;
use Contentful\Tests\RichText\TestCase;

class EmbeddedAssetInlineTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('embedded-asset-inline', EmbeddedAssetInline::getType());

        $nodes = $this->createNodes(5);
        $asset = new Asset('assetId');
        $node = new EmbeddedAssetInline($nodes, $asset);

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($asset, $node->getAsset());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
