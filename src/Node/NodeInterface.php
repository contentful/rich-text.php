<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

/**
 * NodeInterface.
 *
 * A class implementing this interface represents a node,
 * which is the core unit of rich text content.
 * A node can represent text, a list, a paragraph, a full document, etc.
 */
interface NodeInterface extends \JsonSerializable
{
    /**
     * Returns the internal type of a node object.
     *
     * @return string
     */
    public static function getType(): string;

    /**
     * Returns whether the node is of class block or inline.
     *
     * @return string
     */
    public function getNodeClass(): string;
}
