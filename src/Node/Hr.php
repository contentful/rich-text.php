<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class Hr extends BlockNode
{
    /**
     * Hr constructor.
     */
    public function __construct()
    {
        parent::__construct([]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'hr';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
        ];
    }
}
