<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
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
