<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Integration;

use Contentful\RichText\Bridge\TwigExtension;
use Contentful\RichText\Renderer;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\NodeRenderer;
use Contentful\Tests\RichText\Implementation\TwigNodeRenderer;
use Contentful\Tests\RichText\TestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class TwigNodeRendererTest extends TestCase
{
    public function testTwigNodeRenderer()
    {
        // Create a Twig environment
        $loader = new ArrayLoader([]);
        $twig = new Environment($loader);

        // Create a custom node renderer which uses Twig
        $twigNodeRenderer = new TwigNodeRenderer($twig);
        $renderer = new Renderer([$twigNodeRenderer]);

        $rendered = $renderer->render(new Node('Some value'), [
            'contextVar' => 'contextValue',
        ]);

        $this->assertSame('This is a node with type "node" with context var set to "contextValue".', $rendered);
    }

    public function testTwigExtension()
    {
        // Create a Twig environment
        $loader = new ArrayLoader([]);
        $twig = new Environment($loader);

        $renderer = new Renderer();
        $renderer->pushNodeRenderer(new NodeRenderer());
        $extension = new TwigExtension($renderer);
        $twig->addExtension($extension);

        $template = $twig->createTemplate('The output is "{{ rich_text_render(node) }}"');
        $rendered = $template->render([
            'node' => new Node('Some text'),
        ]);

        $this->assertSame('The output is "Some text"', $rendered);

        $template = $twig->createTemplate('The output is "{{ rich_text_render_collection(nodes) }}"');
        $rendered = $template->render([
            'nodes' => [
                new Node('First text -'),
                new Node(' Second text'),
            ],
        ]);

        $this->assertSame('The output is "First text - Second text"', $rendered);
    }
}
