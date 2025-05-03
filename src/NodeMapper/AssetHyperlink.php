<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\AssetInterface;
use Contentful\RichText\Node\AssetHyperlink as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\ParserInterface;

class AssetHyperlink implements NodeMapperInterface
{
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data, ?string $locale): NodeInterface
    {
        $linkData = $data['data']['target']['sys'];
        $params = null === $locale ? [] : ['locale' => $locale];

        /** @var AssetInterface $asset */
        $asset = $linkResolver->resolveLink(
            new Link($linkData['id'], $linkData['linkType']),
            $params
        );

        return new NodeClass(
            $parser->parseCollectionLocalized($data['content'], $locale),
            $asset,
            $data['data']['title'] ?? ''
        );
    }
}
