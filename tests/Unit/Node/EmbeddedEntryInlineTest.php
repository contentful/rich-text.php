<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\EmbeddedEntryInline;
use Contentful\Tests\RichText\Implementation\Entry;
use Contentful\Tests\RichText\TestCase;

class EmbeddedEntryInlineTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('embedded-entry-inline', EmbeddedEntryInline::getType());

        $nodes = $this->createNodes(5);
        $entry = new Entry('entryId');
        $node = new EmbeddedEntryInline($nodes, $entry);

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($entry, $node->getEntry());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
