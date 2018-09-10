<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Mark;

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
    public function render(string $text): string
    {
        return '<code>'.$text.'</code>';
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
