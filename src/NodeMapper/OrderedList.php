<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper;

use Contentful\Core\Api\LinkResolverInterface;
use Contentful\RichText\Node\ListItem;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\OrderedList as NodeClass;
use Contentful\RichText\ParserInterface;

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
