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
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\Node\Paragraph;
use Contentful\StructuredText\Node\Quote as NodeClass;
use Contentful\StructuredText\ParserInterface;

class Quote implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        /** @var Paragraph[] $content */
        $content = $parser->parseCollection($data['content']);

        return new NodeClass($content);
    }
}
