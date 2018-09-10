<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Mark;

class Italic implements MarkInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'italic';
    }

    /**
     * {@inheritdoc}
     */
    public function render(string $text): string
    {
        return '<em>'.$text.'</em>';
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
