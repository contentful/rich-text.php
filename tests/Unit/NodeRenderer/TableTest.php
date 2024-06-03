<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\Table as NodeClass;
use Contentful\RichText\NodeRenderer\Table;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class TableTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new Table();
        $node = new NodeClass([new Node('Some text')]);

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<table>Some text</table>', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\Table\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new Table();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
