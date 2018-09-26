<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit\Node;

use Contentful\StructuredText\Node\Hr;
use Contentful\Tests\StructuredText\TestCase;

class HrTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('hr', Hr::getType());
        $node = new Hr();

        $this->assertSame('block', $node->getNodeClass());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
