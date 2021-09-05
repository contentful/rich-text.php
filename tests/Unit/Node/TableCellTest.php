<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\TableCell;
use Contentful\Tests\RichText\TestCase;

class TableCellTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('table-cell', TableCell::getType());
        $nodes = $this->createNodes(5);
        $node = new TableCell($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
