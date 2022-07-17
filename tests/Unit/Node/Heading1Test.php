<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2022 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Heading1;
use Contentful\Tests\RichText\TestCase;

class Heading1Test extends TestCase
{
    public function testAll()
    {
        $this->assertSame('heading-1', Heading1::getType());
        $nodes = $this->createNodes(5);
        $node = new Heading1($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
