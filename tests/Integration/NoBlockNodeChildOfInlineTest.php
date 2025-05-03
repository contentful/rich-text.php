<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Integration;

use Contentful\RichText\Node\Heading1;
use Contentful\RichText\Node\Hyperlink;
use Contentful\Tests\RichText\TestCase;

class NoBlockNodeChildOfInlineTest extends TestCase
{
    public function testInlineNodesCanNotHaveBlockAsChildren()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Node of class \"Contentful\RichText\Node\Heading1\" can not be set as child of class \"Contentful\RichText\Node\Hyperlink\", as it can not contain block nodes.");

        $block = new Heading1([]);

        new Hyperlink([$block], 'https://www.example.com', '');
    }
}
