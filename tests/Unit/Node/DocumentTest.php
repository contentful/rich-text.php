<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\Document;
use Contentful\Tests\StructuredText\TestCase;

class DocumentTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('document', Document::getType());
        $nodes = $this->createNodes(5);
        $node = new Document($nodes);

        $this->assertSame($nodes, $node->getContent());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
