<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2022 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Mark;

use Contentful\RichText\Mark\Italic;
use Contentful\Tests\RichText\TestCase;

class ItalicTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('italic', Italic::getType());

        $mark = new Italic();
        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $mark);
    }
}
