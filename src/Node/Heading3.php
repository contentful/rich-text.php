<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class Heading3 extends BlockNode
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'heading-3';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'content' => $this->content,
            'data' => new \stdClass(),
        ];
    }
}
