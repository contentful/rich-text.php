<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Mark;

class Underline implements MarkInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'underline';
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
