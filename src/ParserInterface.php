<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText;

use Contentful\RichText\Node\NodeInterface;

/**
 * ParserInterface.
 *
 * A class implementing this interface is responsible for
 * creating a NodeInterface structure starting with a raw data array
 * of unserialized JSON rich text.
 */
interface ParserInterface
{
    /**
     * Transforms an array of rich text into node objects.
     *
     * @param array $data The unserialized JSON rich text
     *
     * @deprecated consider using parseLocalized instead, as this method will not resolve embedded assets with the
     *             correct locale
     */
    public function parse(array $data): NodeInterface;

    /**
     * Transforms an array of rich text into node objects. Uses the given locale for resolving the links.
     *
     * @param array $data The unserialized JSON rich text
     */
    public function parseLocalized(array $data, ?string $locale): NodeInterface;

    /**
     * Transforms an array of rich text into node objects.
     *
     * @return NodeInterface[]
     *
     * @deprecated consider using parseCollectionLocalized instead, as this method will not resolve embedded assets with
     *             the correct locale
     */
    public function parseCollection(array $data): array;

    /**
     * Transforms an array of rich text into node objects.
     *
     * @return NodeInterface[]
     */
    public function parseCollectionLocalized(array $data, ?string $locale): array;
}
