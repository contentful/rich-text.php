<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\ListItem;
use Contentful\Tests\StructuredText\TestCase;

class ListItemTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('list-item', ListItem::getType());
        $nodes = $this->createNodes(5);
        $node = new ListItem($nodes);

        $this->assertSame('block', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
