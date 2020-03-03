<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Bridge;

use Contentful\RichText\Bridge\TwigExtension;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;
use Twig\Node\Node;
use Twig\TwigFunction;

class TwigExtensionTest extends TestCase
{
    public function testTwigExtension()
    {
        $renderer = new Renderer();
        $extension = new TwigExtension($renderer);

        $functions = $extension->getFunctions();
        $this->assertCount(2, $functions);

        $this->assertInstanceOf(TwigFunction::class, $functions[0]);
        $this->assertInstanceOf(TwigFunction::class, $functions[1]);

        /** @var TwigFunction $function */
        $function = $functions[0];
        $this->assertSame('rich_text_render', $function->getName());
        $callable = $function->getCallable();
        $this->assertIsArray($callable);
        $this->assertSame($renderer, $callable[0]);
        $this->assertSame('render', $callable[1]);
        $this->assertSame(['html'], $function->getSafe(new Node()));

        /** @var TwigFunction $function */
        $function = $functions[1];
        $this->assertSame('rich_text_render_collection', $function->getName());
        $callable = $function->getCallable();
        $this->assertIsArray($callable);
        $this->assertSame($renderer, $callable[0]);
        $this->assertSame('renderCollection', $callable[1]);
        $this->assertSame(['html'], $function->getSafe(new Node()));
    }
}
