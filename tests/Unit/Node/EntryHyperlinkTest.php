<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\EntryHyperlink;
use Contentful\RichText\NodeMapper\Reference\StaticEntryReference;
use Contentful\Tests\RichText\Implementation\Entry;
use Contentful\Tests\RichText\TestCase;

class EntryHyperlinkTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('entry-hyperlink', EntryHyperlink::getType());

        $nodes = $this->createNodes(1);
        $entry = new Entry('entryId');
        $node = new EntryHyperlink($nodes, 'Entry link', new StaticEntryReference($entry));

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($entry, $node->getEntry());
        $this->assertSame('Entry link', $node->getTitle());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
