<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\Core\Api\Link;
use Contentful\RichText\Node\EmbeddedEntryBlock;
use Contentful\RichText\NodeMapper\Reference\StaticEntryReference;
use Contentful\Tests\RichText\Implementation\Entry;
use Contentful\Tests\RichText\TestCase;

class EmbeddedEntryBlockTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('embedded-entry-block', EmbeddedEntryBlock::getType());

        $nodes = $this->createNodes(5);
        $entry = new Entry('entryId');
        $staticEntry = new StaticEntryReference($entry);
        $this->assertInstanceOf(Link::class, $staticEntry->getLink());

        $node = new EmbeddedEntryBlock($nodes, $staticEntry);

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($entry, $node->getEntry());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
