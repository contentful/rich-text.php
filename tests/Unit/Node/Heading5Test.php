<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Heading5;
use Contentful\Tests\RichText\TestCase;

class Heading5Test extends TestCase
{
    public function testAll()
    {
        $this->assertSame('heading-5', Heading5::getType());
        $nodes = $this->createNodes(5);
        $node = new Heading5($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
