<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\OrderedList;
use Contentful\Tests\StructuredText\TestCase;

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
