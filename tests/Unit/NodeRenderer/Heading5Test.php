<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\Heading5 as NodeClass;
use Contentful\RichText\NodeRenderer\Heading5;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class Heading5Test extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new Heading5();
        $node = new NodeClass([new Node('Some text')]);

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<h5>Some text</h5>', $nodeRenderer->render($renderer, $node));
    }

    /**
     * @expectedException        \LogicException
     * @expectedExceptionMessage Trying to use node renderer "Contentful\RichText\NodeRenderer\Heading5" to render unsupported node of class "Contentful\Tests\RichText\Implementation\Node".
     */
    public function testInvalidNodeRendered()
    {
        $renderer = new Renderer();
        $nodeRenderer = new Heading5();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
