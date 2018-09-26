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

        $resource = new Resource('resourceId', 'Asset');
        $node = new AssetHyperlink('Asset link', $resource);

        $this->assertSame('inline', $node->getNodeClass());

        $this->assertSame('Asset link', $node->getTitle());
        $this->assertSame($resource, $node->getResource());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
