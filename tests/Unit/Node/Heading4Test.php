<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Heading4;
use Contentful\Tests\RichText\TestCase;

class Heading4Test extends TestCase
{
    public function testAll()
    {
        $this->assertSame('heading-4', Heading4::getType());
        $nodes = $this->createNodes(5);
        $node = new Heading4($nodes);

        $this->assertSame('block', $node->getNodeClass());

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
