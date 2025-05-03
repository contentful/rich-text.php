<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper\Reference;

use Contentful\Core\Resource\EntryInterface;

interface EntryReferenceInterface extends \JsonSerializable
{
    public function getEntry(): EntryInterface;
}
