<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\TableRow;
use Contentful\Tests\RichText\TestCase;

class TableRowTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('table-row', TableRow::getType());
        $nodes = $this->createNodes(5);
        $node = new TableRow($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
