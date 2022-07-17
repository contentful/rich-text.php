<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2022 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Hyperlink;
use Contentful\Tests\RichText\TestCase;

class HyperlinkTest extends TestCase
{
    public function testAll()
    {
        $nodes = $this->createNodes(1);
        $this->assertSame('hyperlink', Hyperlink::getType());
        $node = new Hyperlink($nodes, 'https://www.contentful.com', 'Contentful');

        $this->assertSame($nodes, $node->getContent());
        $this->assertSame('https://www.contentful.com', $node->getUri());
        $this->assertSame('Contentful', $node->getTitle());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
