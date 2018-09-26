<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\Heading2;
use Contentful\Tests\StructuredText\TestCase;

class Heading2Test extends TestCase
{
    public function testAll()
    {
        $this->assertSame('heading-2', Heading2::getType());
        $nodes = $this->createNodes(5);
        $node = new Heading2($nodes);

        $this->assertSame('block', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
