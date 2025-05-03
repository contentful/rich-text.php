<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Mark;

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
     */
    public static function getType(): string;
}
