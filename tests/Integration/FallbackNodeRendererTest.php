<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Integration;

use Contentful\StructuredText\NodeRenderer\CatchAll;
use Contentful\StructuredText\Renderer;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\TestCase;

class FallbackNodeRendererTest extends TestCase
{
    public function testRendererReturnsEmptyStringOnUnsupportedNode()
    {
        $renderer = new Renderer();
        $renderer->appendNodeRenderer(new CatchAll());

        $rendered = $renderer->render(new Node('Some text'));

        $this->assertSame('', $rendered);
    }
}
