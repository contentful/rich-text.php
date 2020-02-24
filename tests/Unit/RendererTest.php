<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit;

use Contentful\RichText\Node\Paragraph;
use Contentful\RichText\Node\Text;
use Contentful\RichText\NodeRenderer as NodeRendererNamespace;
use Contentful\RichText\Renderer;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\NodeRenderer;
use Contentful\Tests\RichText\TestCase;

class RendererTest extends TestCase
{
    /**
     * @var int
     */
    private $defaultNodeRenderersCount;

    protected function setUp(): void
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

    public function testUnsupportedNode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Structured text renderer could not find NodeRenderer instance which supports node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $node = new Node('Some value');

        $renderer->render($node);
    }
}
