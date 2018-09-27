<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\Hyperlink;
use Contentful\Tests\StructuredText\TestCase;

class HyperlinkTest extends TestCase
{
    public function testAll()
    {
        $nodes = $this->createNodes(1);
        $this->assertSame('hyperlink', Hyperlink::getType());
        $node = new Hyperlink($nodes, 'https://www.contentful.com', 'Contentful');

        $this->assertSame('inline', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame('https://www.contentful.com', $node->getUri());
        $this->assertSame('Contentful', $node->getTitle());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
