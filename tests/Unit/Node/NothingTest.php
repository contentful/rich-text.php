<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit\Node;

use Contentful\RichText\Node\Nothing;
use Contentful\Tests\RichText\TestCase;

class NothingTest extends TestCase
{
    public function testGetData()
    {
        $data = [
            'nodeType' => 'invalid-node',
        ];
        $node = new Nothing($data);

        $this->assertSame('nothing', Nothing::getType());

        $this->assertSame($data, $node->getData());

        $this->assertSame($data, $node->jsonSerialize());
    }
}
