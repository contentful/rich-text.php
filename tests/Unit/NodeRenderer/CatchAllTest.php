<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\NodeRenderer;

use Contentful\StructuredText\NodeRenderer\CatchAll;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\Implementation\Renderer;
use Contentful\Tests\StructuredText\TestCase;

class CatchAllTest extends TestCase
{
    public function testRendering()
    {
        $renderer = new Renderer();
        $nodeRenderer = new CatchAll();
        $node = new Node('Some value');

        $this->assertTrue($nodeRenderer->supports($node));

        $this->assertSame('', $nodeRenderer->render($renderer, $node));
    }
}
