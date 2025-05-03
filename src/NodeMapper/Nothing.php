<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper;

use Contentful\Core\Api\LinkResolverInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\Nothing as NodeClass;
use Contentful\RichText\ParserInterface;

class Nothing implements NodeMapperInterface
{
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data, ?string $locale): NodeInterface
    {
        return new NodeClass($data);
    }
}
