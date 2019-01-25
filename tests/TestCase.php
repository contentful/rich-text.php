<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText;

use Contentful\RichText\Mark\MarkInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\Tests\RichText\Implementation\Mark;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * @param int $amount
     *
     * @return NodeInterface[]
     */
    protected function createNodes(int $amount = 5): array
    {
        $nodes = [];
        while ($amount) {
            $nodes[] = new Node(\bin2hex(\random_bytes(5)));
            --$amount;
        }

        return $nodes;
    }

    /**
     * @param int $amount
     *
     * @return MarkInterface[]
     */
    protected function createMarks(int $amount = 5): array
    {
        $nodes = [];
        while ($amount) {
            $nodes[] = new Mark();
            --$amount;
        }

        return $nodes;
    }
}
