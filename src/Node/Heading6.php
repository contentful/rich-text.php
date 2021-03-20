<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class Heading6 extends AbstractHeading
{
    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'heading-6';
    }
}
