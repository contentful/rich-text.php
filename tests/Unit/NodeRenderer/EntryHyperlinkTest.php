<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\NodeRenderer;

use Contentful\StructuredText\Node\EntryHyperlink as NodeClass;
use Contentful\StructuredText\NodeRenderer\EntryHyperlink;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\Implementation\Renderer;
use Contentful\Tests\StructuredText\Implementation\Resource;
use Contentful\Tests\StructuredText\TestCase;

class EntryHyperlinkTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EntryHyperlink();
        $nodes = $this->createNodes(1);
        $node = new NodeClass($nodes, new Resource('resourceId', 'Entry'), 'Entry title');

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertRegExp('/\<a href\=\"\#Entry-resourceId\" title\=\"Entry title\"\>([a-zA-Z0-9]{10})\<\/a\>/', $nodeRenderer->render($renderer, $node));
    }

    /**
     * @expectedException        \LogicException
     * @expectedExceptionMessage Trying to use node renderer "Contentful\StructuredText\NodeRenderer\EntryHyperlink" to render unsupported node of class "Contentful\Tests\StructuredText\Implementation\Node".
     */
    public function testInvalidNodeRendered()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EntryHyperlink();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
