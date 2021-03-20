<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Mark;

class Code implements MarkInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'code';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'object' => 'mark',
            'type' => self::getType(),
        ];
    }
}
