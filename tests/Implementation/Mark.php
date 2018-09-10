<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Implementation;

use Contentful\StructuredText\Mark\MarkInterface;

/**
 * Basic implementation of MarkInterface for testing purposes.
 */
class Mark implements MarkInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'mark';
    }

    /**
     * {@inheritdoc}
     */
    public function render(string $text): string
    {
        return '<mark>'.$text.'</mark>';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'object' => 'mark',
            'type' => self::getType(),
        ];
    }
}
