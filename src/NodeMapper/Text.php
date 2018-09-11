<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\NodeMapper;

use Contentful\StructuredText\Mark;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\StructuredText\Mark\MarkInterface;
use Contentful\StructuredText\Node\Text as NodeClass;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\ParserInterface;

class Text implements NodeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function map(ParserInterface $parser, LinkResolverInterface $linkResolver, array $data): NodeInterface
    {
        return new NodeClass(
            $data['value'],
            \array_map([$this, 'parseMark'], $data['marks'])
        );
    }

    /**
     * @param array $data
     *
     * @return MarkInterface
     */
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
            default:
                throw new \InvalidArgumentException(\sprintf(
                    'Unrecognized mark type "%s" when trying to parse structured text.',
                    $data['type']
                ));
        }
    }
}
