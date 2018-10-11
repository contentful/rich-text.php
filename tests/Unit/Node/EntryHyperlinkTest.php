<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\EntryHyperlink;
use Contentful\Tests\RichText\Implementation\Resource;
use Contentful\Tests\RichText\TestCase;

class EntryHyperlinkTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('entry-hyperlink', EntryHyperlink::getType());

        $nodes = $this->createNodes(1);
        $resource = new Resource('resourceId', 'Entry');
        $node = new EntryHyperlink($nodes, $resource, 'Entry link');

        $this->assertSame('inline', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame($resource, $node->getResource());
        $this->assertSame('Entry link', $node->getTitle());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
