<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\EntryInterface;
use Contentful\RichText\Exception\MapperException;
use Contentful\RichText\Node\EmbeddedEntryBlock as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\ParserInterface;

class EmbeddedEntryBlock implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        $linkData = $data['data']['target']['sys'];

        try {
            /** @var EntryInterface $entry */
            $entry = $linkResolver->resolveLink(
                new Link($linkData['id'], $linkData['linkType'])
            );
        } catch (\Throwable $exception) {
            throw new MapperException($data);
        }

        return new NodeClass(
            $parser->parseCollection($data['content']),
            $entry
        );
    }
}
