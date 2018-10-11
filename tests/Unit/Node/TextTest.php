<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Text;
use Contentful\Tests\RichText\TestCase;

class TextTest extends TestCase
{
    public function testAll()
    {
        $this->assertSame('text', Text::getType());
        $marks = $this->createMarks(5);
        $node = new Text('Some text', $marks);

        $this->assertSame('inline', $node->getNodeClass());

        $this->assertSame('Some text', $node->getValue());
        $this->assertSame($marks, $node->getMarks());

        $this->assertJsonFixtureEqualsJsonObject('serialize.json', $node);
    }
}
