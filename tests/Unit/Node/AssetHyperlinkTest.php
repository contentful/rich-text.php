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
use Contentful\Tests\RichText\Implementation\Resource;
use Contentful\Tests\RichText\TestCase;

class AssetHyperlinkTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('asset-hyperlink', AssetHyperlink::getType());

        $nodes = $this->createNodes(1);
        $resource = new Resource('resourceId', 'Asset');
        $node = new AssetHyperlink($nodes, $resource, 'Asset link');

        $this->assertSame('inline', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($resource, $node->getResource());
        $this->assertSame('Asset link', $node->getTitle());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
