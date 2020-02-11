<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper\Reference;

use Contentful\Core\Resource\ResourceInterface;
use JsonSerializable;

interface EntryReferenceInterface extends JsonSerializable
{
    public function getEntry(): ResourceInterface;
}
