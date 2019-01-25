<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\EmbeddedAssetBlock as NodeClass;
use Contentful\RichText\NodeRenderer\EmbeddedAssetBlock;
use Contentful\Tests\RichText\Implementation\Asset;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class EmbeddedAssetBlockTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedAssetBlock();
        $node = new NodeClass([], new Asset('assetId'));

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<div>Asset#assetId</div>', $nodeRenderer->render($renderer, $node));
    }

    /**
     * @expectedException        \LogicException
     * @expectedExceptionMessage Trying to use node renderer "Contentful\RichText\NodeRenderer\EmbeddedAssetBlock" to render unsupported node of class "Contentful\Tests\RichText\Implementation\Node".
     */
    public function testInvalidNodeRendered()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedAssetBlock();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
