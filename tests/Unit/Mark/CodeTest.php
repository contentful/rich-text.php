<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Mark;

use Contentful\StructuredText\Mark\Code;
use Contentful\Tests\StructuredText\TestCase;

class CodeTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('code', Code::getType());

        $mark = new Code();
        $this->assertSame('<code>Some text</code>', $mark->render('Some text'));

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $mark);
    }
}
