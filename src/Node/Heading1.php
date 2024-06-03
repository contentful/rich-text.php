<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class Heading1 extends AbstractHeading
{
    public static function getType(): string
    {
        return 'heading-1';
    }
}
