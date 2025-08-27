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
use Contentful\RichText\Mark;
use Contentful\RichText\Mark\MarkInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\Text as NodeClass;
use Contentful\RichText\ParserInterface;

class Text implements NodeMapperInterface
{
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data, ?string $locale): NodeInterface
    {
        return new NodeClass(
            $data['value'],
            array_map([$this, 'parseMark'], $data['marks'])
        );
    }

    private function parseMark(array $data): MarkInterface
    {
        switch ($data['type']) {
            case Mark\Bold::getType():
                return new Mark\Bold();
            case Mark\Code::getType():
                return new Mark\Code();
            case Mark\Italic::getType():
                return new Mark\Italic();
            case Mark\Underline::getType():
                return new Mark\Underline();
            case Mark\Strikethrough::getType():
                return new Mark\Strikethrough();
            case Mark\Superscript::getType():
                return new Mark\Superscript();
            case Mark\Subscript::getType():
                return new Mark\Subscript();
            default:
                throw new \InvalidArgumentException(\sprintf('Unrecognized mark type "%s" when trying to parse rich text.', $data['type']));
        }
    }
}
