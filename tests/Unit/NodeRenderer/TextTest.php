<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\Mark;
use Contentful\RichText\Node\Text as NodeClass;
use Contentful\RichText\NodeRenderer\Text;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

class TextTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new Text();
        $node = new NodeClass('Some text', [
            new Mark\Bold(),
            new Mark\Code(),
            new Mark\Italic(),
            new Mark\Underline(),
        ]);

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertSame('<u><em><code><strong>Some text</strong></code></em></u>', $nodeRenderer->render($renderer, $node));
    }

    public function testEscapingHtml()
    {
        $renderer = new Renderer();
        $nodeRenderer = new Text();
        $node = new NodeClass('Some test with <table><tr><td>TEST</td></tr></table> HTML', [
            new Mark\Bold(),
        ]);

        $this->assertSame('<strong>Some test with &lt;table&gt;&lt;tr&gt;&lt;td&gt;TEST&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt; HTML</strong>', $nodeRenderer->render($renderer, $node));
    }

    public function testInvalidNodeRendered()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\Text\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new Text();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
