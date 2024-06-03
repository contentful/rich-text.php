<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\Hyperlink as NodeClass;
use Contentful\RichText\NodeRenderer\Hyperlink;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class HyperlinkTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new Hyperlink();
        $nodes = $this->createNodes(1);
        $node = new NodeClass($nodes, 'https://www.contentful.com', 'Contentful');

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertRegExp('/\<a href\=\"https\:\/\/www\.contentful\.com\" title\=\"Contentful\"\>([a-zA-Z0-9]{10})\<\/a\>/', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\Hyperlink\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new Hyperlink();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
