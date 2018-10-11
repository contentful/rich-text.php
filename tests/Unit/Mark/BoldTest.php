<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Mark;

use Contentful\RichText\Mark\Bold;
use Contentful\Tests\RichText\TestCase;

class BoldTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('bold', Bold::getType());

        $mark = new Bold();
        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $mark);
    }
}
