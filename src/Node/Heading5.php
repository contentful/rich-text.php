<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class Heading5 extends AbstractHeading
{
    public static function getType(): string
    {
        return 'heading-5';
    }
}
