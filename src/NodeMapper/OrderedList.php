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
use Contentful\RichText\Node\ListItem;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\OrderedList as NodeClass;
use Contentful\RichText\ParserInterface;

class OrderedList implements NodeMapperInterface
{
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data, ?string $locale): NodeInterface
    {
        /** @var ListItem[] $content */
        $content = $parser->parseCollectionLocalized($data['content'], $locale);

        return new NodeClass($content);
    }
}
