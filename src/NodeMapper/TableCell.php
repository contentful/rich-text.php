<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2022 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeMapper;

use Contentful\Core\Api\LinkResolverInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\TableCell as NodeClass;
use Contentful\RichText\ParserInterface;

class TableCell implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data, string|null $locale): NodeInterface
    {
        return new NodeClass($parser->parseCollectionLocalized($data['content'], $locale));
    }
}
