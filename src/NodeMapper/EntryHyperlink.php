<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\NodeMapper;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\StructuredText\Node\EntryHyperlink as NodeClass;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\ParserInterface;

class EntryHyperlink implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        $linkData = $data['data']['target']['sys'];

        return new NodeClass(
            $parser->parseCollection($data['content']),
            $linkResolver->resolveLink(
                new Link($linkData['id'], $linkData['linkType'])
            ),
            $data['data']['title'] ?? ''
        );
    }
}
