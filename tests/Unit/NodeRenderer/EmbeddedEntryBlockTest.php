<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\Core\Api\Link;
use Contentful\RichText\Node\EmbeddedEntryBlock as NodeClass;
use Contentful\RichText\NodeMapper\Reference\EntryReference;
use Contentful\RichText\NodeRenderer\EmbeddedEntryBlock;
use Contentful\Tests\RichText\Implementation\LinkResolver;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class EmbeddedEntryBlockTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedEntryBlock();

        $reference = new EntryReference(new Link('entryId', 'Entry'), new LinkResolver(), null);
        $node = new NodeClass([], $reference);

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));
        $this->assertInstanceOf(Link::class, $reference->getLink());

        $this->assertSame('<div>Entry#entryId</div>', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\EmbeddedEntryBlock\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new EmbeddedEntryBlock();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
