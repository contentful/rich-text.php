<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\EntryInterface;
use Contentful\RichText\Node\EntryHyperlink as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\ParserInterface;

class EntryHyperlink implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        $linkData = $data['data']['target']['sys'];

        /** @var EntryInterface $entry */
        $entry = $linkResolver->resolveLink(
            new Link($linkData['id'], $linkData['linkType'])
        );

        return new NodeClass(
            $parser->parseCollection($data['content']),
            $entry,
            $data['data']['title'] ?? ''
        );
    }
}
