<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\TableRow as NodeClass;
use Contentful\RichText\NodeRenderer\TableRow;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class TableRowTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new TableRow();
        $node = new NodeClass([new Node('Some text')]);

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<tr>Some text</tr>', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\TableRow\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new TableRow();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
