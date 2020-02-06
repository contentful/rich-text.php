<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\ListItem;
use Contentful\Tests\RichText\TestCase;

class ListItemTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('list-item', ListItem::getType());
        $nodes = $this->createNodes(5);
        $node = new ListItem($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
