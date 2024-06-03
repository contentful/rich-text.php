<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Mark;

class Bold implements MarkInterface
{
    public static function getType(): string
    {
        return 'bold';
    }

    public function jsonSerialize(): array
    {
        return [
            'object' => 'mark',
            'type' => self::getType(),
        ];
    }
}
