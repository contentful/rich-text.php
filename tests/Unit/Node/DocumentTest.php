<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Document;
use Contentful\Tests\RichText\TestCase;

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
