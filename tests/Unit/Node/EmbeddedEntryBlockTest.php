<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\EmbeddedEntryBlock;
use Contentful\Tests\RichText\Implementation\Resource;
use Contentful\Tests\RichText\TestCase;

class EmbeddedEntryBlockTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('embedded-entry-block', EmbeddedEntryBlock::getType());

        $nodes = $this->createNodes(5);
        $resource = new Resource('resourceId', 'Entry');
        $node = new EmbeddedEntryBlock($nodes, $resource);

        $this->assertSame('block', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($resource, $node->getResource());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
