<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Heading2;
use Contentful\Tests\RichText\TestCase;

class Heading2Test extends TestCase
{
    public function testAll()
    {
        $this->assertSame('heading-2', Heading2::getType());
        $nodes = $this->createNodes(5);
        $node = new Heading2($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
