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

        $resource = new Resource('resourceId', 'Entry');
        $node = new EntryHyperlink('Entry link', $resource);

        $this->assertSame('Entry link', $node->getTitle());
        $this->assertSame($resource, $node->getResource());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
