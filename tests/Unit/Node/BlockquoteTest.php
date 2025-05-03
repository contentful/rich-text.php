<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Blockquote;
use Contentful\Tests\RichText\TestCase;

class BlockquoteTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('blockquote', Blockquote::getType());
        $nodes = $this->createNodes(5);
        $node = new Blockquote($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
