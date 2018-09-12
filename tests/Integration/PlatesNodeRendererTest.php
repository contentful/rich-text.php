<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Integration;

use Contentful\StructuredText\Bridge\PlatesExtension;
use Contentful\StructuredText\Renderer;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\Implementation\NodeRenderer;
use Contentful\Tests\StructuredText\Implementation\PlatesNodeRenderer;
use Contentful\Tests\StructuredText\TestCase;
use League\Plates\Engine;

class PlatesNodeRendererTest extends TestCase
{
    public function testPlatesNodeRenderer()
    {
        $path = $this->convertClassToFixturePath(static::class);
        // Create a Plates engine
        $engine = new Engine($path);

        // Create a custom node renderer which uses Plates
        $platesNodeRenderer = new PlatesNodeRenderer($engine);
        $renderer = new Renderer([$platesNodeRenderer]);

        $rendered = $renderer->render(new Node('Some value'), [
            'contextVar' => 'contextValue',
        ]);

        $this->assertSame('This is a node with type "node" with context var set to "contextValue".'."\n", $rendered);
    }

    public function testPlatesExtension()
    {
        $path = $this->convertClassToFixturePath(static::class);
        // Create a Plates engine
        $engine = new Engine($path);

        $renderer = new Renderer();
        $renderer->pushNodeRenderer(new NodeRenderer());
        $engine->loadExtension(new PlatesExtension($renderer));

        $rendered = $engine->render('singleNode', [
            'node' => new Node('Some text'),
        ]);

        $this->assertSame('The output is "Some text"'."\n", $rendered);

        $rendered = $engine->render('collectionNodes', [
            'nodes' => [
                new Node('First text -'),
                new Node(' Second text'),
            ],
        ]);

        $this->assertSame('The output is "First text - Second text"'."\n", $rendered);
    }
}
