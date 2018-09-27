<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\NodeRenderer;

use Contentful\StructuredText\Node\EmbeddedEntryBlock as NodeClass;
use Contentful\StructuredText\NodeRenderer\EmbeddedEntryBlock;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\Implementation\Renderer;
use Contentful\Tests\StructuredText\Implementation\Resource;
use Contentful\Tests\StructuredText\TestCase;

class EmbeddedEntryBlockTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedEntryBlock();
        $node = new NodeClass([], new Resource('resourceId', 'Entry'));

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<div>Entry#resourceId</div>', $nodeRenderer->render($renderer, $node));
    }

    /**
     * @expectedException        \LogicException
     * @expectedExceptionMessage Trying to use node renderer "Contentful\StructuredText\NodeRenderer\EmbeddedEntryBlock" to render unsupported node of class "Contentful\Tests\StructuredText\Implementation\Node".
     */
    public function testInvalidNodeRendered()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedEntryBlock();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
