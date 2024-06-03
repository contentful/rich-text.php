<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\Core\Api\LinkResolverInterface;
use Contentful\RichText\Mark\MarkInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\NodeMapper\NodeMapperInterface;
use Contentful\RichText\ParserInterface;

/**
 * Basic implementation of MarkInterface for testing purposes.
 */
class NodeMapper implements NodeMapperInterface
{
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data, ?string $locale): NodeInterface
    {
        return new Node($data['value']);
    }
}
