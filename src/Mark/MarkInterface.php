<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Mark;

/**
 * MarkInterface.
 *
 * A class implementing this interface represents a mark,
 * which is something that can be applied to a text node.
 */
interface MarkInterface extends \JsonSerializable
{
    /**
     * Returns the internal type of a mark object.
     *
     * @return string
     */
    public static function getType(): string;
}
