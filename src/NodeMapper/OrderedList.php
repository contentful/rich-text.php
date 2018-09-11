<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\NodeMapper;

use Contentful\Core\Api\LinkResolverInterface;
use Contentful\StructuredText\Node\OrderedList as NodeClass;
use Contentful\StructuredText\Node\ListItem;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\ParserInterface;

class OrderedList implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        /** @var ListItem[] $content */
        $content = $parser->parseCollection($data['content']);

        return new NodeClass($content);
    }
}
