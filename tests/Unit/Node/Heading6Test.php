<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Heading6;
use Contentful\Tests\RichText\TestCase;

class Heading6Test extends TestCase
{
    public function testAll()
    {
        $this->assertSame('heading-6', Heading6::getType());
        $nodes = $this->createNodes(5);
        $node = new Heading6($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
