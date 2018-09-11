<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Implementation;

use Contentful\Core\Api\LinkResolverInterface;
use Contentful\StructuredText\Mark\MarkInterface;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\NodeMapper\NodeMapperInterface;
use Contentful\StructuredText\ParserInterface;

/**
 * Basic implementation of MarkInterface for testing purposes.
 */
class NodeMapper implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        return new Node($data['value']);
    }
}
