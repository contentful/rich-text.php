<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\OrderedList;
use Contentful\Tests\RichText\TestCase;

class OrderedListTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('ordered-list', OrderedList::getType());
        $nodes = $this->createNodes(5);
        $node = new OrderedList($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
