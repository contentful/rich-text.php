<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Integration;

use Contentful\StructuredText\Node\Heading1;
use Contentful\StructuredText\Node\Hyperlink;
use Contentful\Tests\StructuredText\TestCase;

class NoBlockNodeChildOfInlineTest extends TestCase
{
    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Node of class "Contentful\StructuredText\Node\Heading1" can not be set as child of class "Contentful\StructuredText\Node\Hyperlink", as it can not contain block nodes.
     */
    public function testInlineNodesCanNotHaveBlockAsChildren()
    {
        $block = new Heading1([]);

        new Hyperlink([$block], 'https://www.example.com', '');
    }
}
