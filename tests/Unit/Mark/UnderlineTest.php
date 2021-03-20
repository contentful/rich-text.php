<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Mark;

use Contentful\RichText\Mark\Underline;
use Contentful\Tests\RichText\TestCase;

class UnderlineTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('underline', Underline::getType());

        $mark = new Underline();
        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $mark);
    }
}
