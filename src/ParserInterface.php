<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText;

use Contentful\StructuredText\Node\NodeInterface;

/**
 * ParserInterface.
 *
 * A class implementing this interface is responsible for
 * creating a NodeInterface structured starting with a raw data array
 * of unserialized JSON structured text.
 */
interface ParserInterface
{
    /**
     * Transforms an array of structured text into node objects.
     *
     * @param array $data The unserialized JSON structured text
     *
     * @return NodeInterface
     */
    public function parse(array $data): NodeInterface;

    /**
     * Transforms an array of structured text into node objects.
     *
     * @param array $data
     *
     * @return NodeInterface[]
     */
    public function parseCollection(array $data): array;
}
