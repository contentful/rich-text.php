<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\EmbeddedEntryInline as NodeClass;
use Contentful\RichText\NodeMapper\Reference\StaticEntryReference;
use Contentful\RichText\NodeRenderer\EmbeddedEntryInline;
use Contentful\Tests\RichText\Implementation\Entry;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class EmbeddedEntryInlineTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedEntryInline();
        $node = new NodeClass([], new StaticEntryReference(new Entry('entryId')));

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<span>Entry#entryId</span>', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\EmbeddedEntryInline\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedEntryInline();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
