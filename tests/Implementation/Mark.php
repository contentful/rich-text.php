<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\RichText\Mark\MarkInterface;

/**
 * Basic implementation of MarkInterface for testing purposes.
 */
class Mark implements MarkInterface
{
    public static function getType(): string
    {
        return 'mark';
    }

    public function render(string $text): string
    {
        return '<mark>'.$text.'</mark>';
    }

    public function jsonSerialize(): mixed
    {
        return [
            'object' => 'mark',
            'type' => self::getType(),
        ];
    }
}
