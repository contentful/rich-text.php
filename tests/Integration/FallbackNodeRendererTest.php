<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Integration;

use Contentful\RichText\NodeRenderer\CatchAll;
use Contentful\RichText\Renderer;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\TestCase;

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
