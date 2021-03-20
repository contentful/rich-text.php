<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class UnorderedList extends BlockNode
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'unordered-list';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'content' => $this->content,
        ];
    }
}
