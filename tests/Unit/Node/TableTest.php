<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Table;
use Contentful\Tests\RichText\TestCase;

class TableTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('table', Table::getType());
        $nodes = $this->createNodes(5);
        $node = new Table($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}