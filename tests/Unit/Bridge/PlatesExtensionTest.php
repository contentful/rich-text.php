<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Bridge;

use Contentful\RichText\Bridge\PlatesExtension;
use Contentful\RichText\RendererInterface;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;
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
                    case 'richTextRender':
                        $this->assertInternalType('array', $callback);
                        $this->assertInstanceOf(RendererInterface::class, $callback[0]);
                        $this->assertSame('render', $callback[1]);
                        break;
                    case 'richTextRenderCollection':
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
