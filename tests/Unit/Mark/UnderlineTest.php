<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Mark;

use Contentful\StructuredText\Mark\Underline;
use Contentful\Tests\StructuredText\TestCase;

class UnderlineTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('underline', Underline::getType());

        $mark = new Underline();
        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $mark);
    }
}
