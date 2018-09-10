<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\Heading5;
use Contentful\Tests\StructuredText\TestCase;

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
