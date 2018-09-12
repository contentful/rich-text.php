<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Bridge;

use Contentful\StructuredText\Bridge\TwigExtension;
use Contentful\Tests\StructuredText\Implementation\Renderer;
use Contentful\Tests\StructuredText\TestCase;
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
        $this->assertSame('structured_text_render', $function->getName());
        $callable = $function->getCallable();
        $this->assertInternalType('array', $callable);
        $this->assertSame($renderer, $callable[0]);
        $this->assertSame('render', $callable[1]);
        $this->assertSame(['html'], $function->getSafe(new Node()));

        /** @var TwigFunction $function */
        $function = $functions[1];
        $this->assertSame('structured_text_render_collection', $function->getName());
        $callable = $function->getCallable();
        $this->assertInternalType('array', $callable);
        $this->assertSame($renderer, $callable[0]);
        $this->assertSame('renderCollection', $callable[1]);
        $this->assertSame(['html'], $function->getSafe(new Node()));
    }
}
