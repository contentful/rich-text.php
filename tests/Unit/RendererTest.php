<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit;

use Contentful\StructuredText\Node\Paragraph;
use Contentful\StructuredText\Node\Text;
use Contentful\StructuredText\NodeRenderer as NodeRendererNamespace;
use Contentful\StructuredText\Renderer;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\Implementation\NodeRenderer;
use Contentful\Tests\StructuredText\TestCase;

class RendererTest extends TestCase
{
    /**
     * @var int
     */
    private $defaultNodeRenderersCount;

    public function setUp()
    {
        $this->defaultNodeRenderersCount = \count((new Renderer())->getNodeRenderers());
    }

    public function testDefaultNodeRenders()
    {
        $renderer = new Renderer();

        $nodeRenderers = $renderer->getNodeRenderers();

        $this->assertContainsOnlyInstancesOf(NodeRendererNamespace\NodeRendererInterface::class, $nodeRenderers);
    }

    public function testAddCustomNodeRendererOnConstruct()
    {
        $nodeRenderer = new NodeRenderer();
        $renderer = new Renderer([$nodeRenderer]);

        $nodeRenderers = $renderer->getNodeRenderers();
        $this->assertCount($this->defaultNodeRenderersCount + 1, $nodeRenderers);

        $this->assertSame($nodeRenderer, $nodeRenderers[0]);
        $this->assertContainsOnlyInstancesOf(NodeRendererNamespace\NodeRendererInterface::class, $nodeRenderers);
    }

    public function testAddCustomNodeRendererAfterConstruct()
    {
        $renderer = new Renderer();

        $nodeRenderers = $renderer->getNodeRenderers();
        $this->assertContainsOnlyInstancesOf(NodeRendererNamespace\NodeRendererInterface::class, $nodeRenderers);
        $this->assertInstanceOf(NodeRendererNamespace\AssetHyperlink::class, $nodeRenderers[0]);

        $nodeRenderer = new NodeRenderer();
        $renderer->pushNodeRenderer($nodeRenderer);

        $nodeRenderers = $renderer->getNodeRenderers();
        $this->assertCount($this->defaultNodeRenderersCount + 1, $nodeRenderers);

        $this->assertSame($nodeRenderer, $nodeRenderers[0]);
        $this->assertInstanceOf(NodeRendererNamespace\AssetHyperlink::class, $nodeRenderers[1]);
    }

    public function testRenderSingleNode()
    {
        $renderer = new Renderer();
        $node = new Text('Some text');

        $this->assertSame('Some text', $renderer->render($node));
    }

    public function testRenderNodeCollection()
    {
        $renderer = new Renderer();
        $nodes = [
            new Paragraph([new Text('First text')]),
            new Paragraph([new Text('Second text')]),
        ];

        $this->assertSame('<p>First text</p><p>Second text</p>', $renderer->renderCollection($nodes));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Structured text renderer could not find NodeRenderer instance which supports node of class "Contentful\Tests\StructuredText\Implementation\Node".
     */
    public function testUnsupportedNode()
    {
        $renderer = new Renderer();
        $node = new Node('Some value');

        $renderer->render($node);
    }
}
