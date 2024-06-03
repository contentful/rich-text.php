<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Node\EntryHyperlink as NodeClass;
use Contentful\RichText\NodeMapper\Reference\StaticEntryReference;
use Contentful\RichText\NodeRenderer\EntryHyperlink;
use Contentful\Tests\RichText\Implementation\Entry;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class EntryHyperlinkTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new EntryHyperlink();
        $nodes = $this->createNodes(1);
        $node = new NodeClass($nodes, new StaticEntryReference(new Entry('entryId')), 'Entry title');

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertRegExp('/\<a href\=\"\#Entry-entryId\" title\=\"Entry title\"\>([a-zA-Z0-9]{10})\<\/a\>/', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\EntryHyperlink\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new EntryHyperlink();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
