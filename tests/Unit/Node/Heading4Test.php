<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\Heading4;
use Contentful\Tests\StructuredText\TestCase;

class Heading4Test extends TestCase
{
    public function testAll()
    {
        $this->assertSame('heading-4', Heading4::getType());
        $nodes = $this->createNodes(5);
        $node = new Heading4($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
