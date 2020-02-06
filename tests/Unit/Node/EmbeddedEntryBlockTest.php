<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\EmbeddedEntryBlock;
use Contentful\Tests\RichText\Implementation\Entry;
use Contentful\Tests\RichText\TestCase;

class EmbeddedEntryBlockTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('embedded-entry-block', EmbeddedEntryBlock::getType());

        $nodes = $this->createNodes(5);
        $entry = new Entry('entryId');
        $node = new EmbeddedEntryBlock($nodes, $entry);

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($entry, $node->getEntry());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
