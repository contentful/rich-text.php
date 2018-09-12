<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Bridge;

use Contentful\StructuredText\Bridge\PlatesExtension;
use Contentful\StructuredText\RendererInterface;
use Contentful\Tests\StructuredText\Implementation\Renderer;
use Contentful\Tests\StructuredText\TestCase;
use League\Plates\Engine;

class PlatesExtensionTest extends TestCase
{
    public function testPlatesExtension()
    {
        $renderer = new Renderer();
        $extension = new PlatesExtension($renderer);

        $engine = $this->getMockBuilder(Engine::class)
            ->getMock()
        ;
        $engine->method('registerFunction')
            ->willReturnCallback(function (string $name, callable $callback) {
                switch ($name) {
                    case 'structuredTextRender':
                        $this->assertInternalType('array', $callback);
                        $this->assertInstanceOf(RendererInterface::class, $callback[0]);
                        $this->assertSame('render', $callback[1]);
                        break;
                    case 'structuredTextRenderCollection':
                        $this->assertInternalType('array', $callback);
                        $this->assertInstanceOf(RendererInterface::class, $callback[0]);
                        $this->assertSame('renderCollection', $callback[1]);
                        break;
                    default:
                        $this->fail(\sprintf(
                            'Unrecognized extension name "%s"',
                            $name
                        ));
                }
            })
        ;

        $extension->register($engine);
    }
}
