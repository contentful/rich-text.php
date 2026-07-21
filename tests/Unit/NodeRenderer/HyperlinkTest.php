<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2026 Contentful GmbH
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
    public function testRendering(): void
    {
        $renderer = new Renderer();
        $nodeRenderer = new Hyperlink();
        $nodes = $this->createNodes(1);
        $node = new NodeClass($nodes, 'https://www.contentful.com', 'Contentful');

        $this->assertTrue($nodeRenderer->supports($node));
        $this->assertFalse($nodeRenderer->supports(new Node('Some value')));

        $this->assertRegExp('/\<a href\=\"https\:\/\/www\.contentful\.com\" title\=\"Contentful\"\>([a-zA-Z0-9]{10})\<\/a\>/', $nodeRenderer->render($renderer, $node));
    }

    /**
     * @dataProvider dangerousUriProvider
     */
    public function testDangerousSchemesAreNeutralized(string $uri): void
    {
        $renderer = new Renderer();
        $nodeRenderer = new Hyperlink();
        $node = new NodeClass($this->createNodes(1), $uri, 'Contentful');

        $rendered = $nodeRenderer->render($renderer, $node);

        $this->assertStringContainsString('href="#"', $rendered);
        $this->assertStringNotContainsStringIgnoringCase('javascript', $rendered);
    }

    public function dangerousUriProvider(): array
    {
        return [
            'plain javascript' => ['javascript:alert(1)'],
            'uppercase javascript' => ['JavaScript:alert(1)'],
            'leading space' => [' javascript:alert(1)'],
            'leading tab' => ["\tjavascript:alert(1)"],
            'embedded tab' => ["java\tscript:alert(1)"],
            'embedded newline' => ["java\nscript:alert(1)"],
            'leading control char' => ["\x01javascript:alert(1)"],
            'data uri' => ['data:text/html,<script>alert(1)</script>'],
            'vbscript' => ['vbscript:msgbox(1)'],
            'protocol-relative' => ['//attacker.com/phish'],
            'protocol-relative with control char' => ["/\t/attacker.com/phish"],
        ];
    }

    /**
     * @dataProvider safeUriProvider
     */
    public function testSafeSchemesArePreserved(string $uri, string $expectedHref): void
    {
        $renderer = new Renderer();
        $nodeRenderer = new Hyperlink();
        $node = new NodeClass($this->createNodes(1), $uri, 'Contentful');

        $this->assertStringContainsString('href="'.$expectedHref.'"', $nodeRenderer->render($renderer, $node));
    }

    public function safeUriProvider(): array
    {
        return [
            'https' => ['https://www.contentful.com', 'https://www.contentful.com'],
            'http' => ['http://example.com', 'http://example.com'],
            'relative path' => ['/some/path', '/some/path'],
            'fragment' => ['#anchor', '#anchor'],
            'query preserved and escaped' => ['https://example.com/?a=1&b=2', 'https://example.com/?a=1&amp;b=2'],
            'mailto' => ['mailto:hello@contentful.com', 'mailto:hello@contentful.com'],
            'tel' => ['tel:+1-555-0100', 'tel:+1-555-0100'],
        ];
    }

    public function testInvalidNodeRendered(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Trying to use node renderer \"Contentful\RichText\NodeRenderer\Hyperlink\" to render unsupported node of class \"Contentful\Tests\RichText\Implementation\Node\".");

        $renderer = new Renderer();
        $nodeRenderer = new Hyperlink();

        $nodeRenderer->render($renderer, new Node('Some value'));
    }
}
