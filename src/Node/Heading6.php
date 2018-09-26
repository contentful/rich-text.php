<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Node;

class Heading6 extends BlockNode
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'heading-6';
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
