<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\Nothing as NodeClass;
use Contentful\RichText\NodeRenderer\Nothing;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class NothingTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new Nothing();
        $node = new NodeClass();

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\Nothing\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new Nothing();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
