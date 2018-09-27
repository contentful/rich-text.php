<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\AssetHyperlink;
use Contentful\Tests\StructuredText\Implementation\Resource;
use Contentful\Tests\StructuredText\TestCase;

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
