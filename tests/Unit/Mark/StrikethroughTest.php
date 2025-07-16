<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Mark;

use Contentful\RichText\Mark\Strikethrough;
use Contentful\Tests\RichText\TestCase;

class StrikethroughTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('strikethrough', Strikethrough::getType());

        $mark = new Strikethrough();
        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $mark);
    }
}
