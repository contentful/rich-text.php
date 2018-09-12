<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Mark;

use Contentful\StructuredText\Mark\Bold;
use Contentful\Tests\StructuredText\TestCase;

class BoldTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('bold', Bold::getType());

        $mark = new Bold();
        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $mark);
    }
}
