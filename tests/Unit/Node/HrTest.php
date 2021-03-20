<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Hr;
use Contentful\Tests\RichText\TestCase;

class HrTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('hr', Hr::getType());
        $node = new Hr();

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
