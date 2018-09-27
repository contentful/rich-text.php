<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\EntryHyperlink;
use Contentful\Tests\StructuredText\Implementation\Resource;
use Contentful\Tests\StructuredText\TestCase;

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
