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
use Contentful\RichText\Node\Blockquote as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\Paragraph;
use Contentful\RichText\ParserInterface;

class Blockquote implements NodeMapperInterface
{
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data, ?string $locale): NodeInterface
    {
        /** @var Paragraph[] $content */
        $content = $parser->parseCollectionLocalized($data['content'], $locale);

        return new NodeClass($content);
    }
}
