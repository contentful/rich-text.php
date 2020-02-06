<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2020 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper;

use Contentful\Core\Api\LinkResolverInterface;
use Contentful\RichText\Node\Hyperlink as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\ParserInterface;

class Hyperlink implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        return new NodeClass(
            $parser->parseCollection($data['content']),
            $data['data']['uri'],
            $data['data']['title'] ?? ''
        );
    }
}
