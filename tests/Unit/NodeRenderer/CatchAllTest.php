<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\NodeRenderer;

use Contentful\RichText\NodeRenderer\CatchAll;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\Renderer;
use Contentful\Tests\RichText\TestCase;

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
