<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\TableCell as NodeClass;
use Contentful\RichText\NodeRenderer\TableCell;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class TableCellTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new TableCell();
        $node = new NodeClass([new Node('Some text')]);

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<td>Some text</td>', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\TableCell\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new TableCell();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
