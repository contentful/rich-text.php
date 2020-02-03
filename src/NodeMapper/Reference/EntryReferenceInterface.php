<?php
namespace Contentful\RichText\NodeMapper\Reference;

use Contentful\Core\Resource\EntryInterface;
use JsonSerializable;

interface EntryReferenceInterface extends JsonSerializable
{
    public function getEntry(): EntryInterface;
}
