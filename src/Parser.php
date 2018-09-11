<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\StructuredText\Mark\MarkInterface;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\NodeMapper\NodeMapperInterface;

/**
 * Parser class.
 */
class Parser implements ParserInterface
{
    /**
     * @var LinkResolverInterface
     */
    private $linkResolver;

    /**
     * @var NodeMapperInterface[]
     */
    private $mappers = [];

    /**
     * Parser constructor.
     *
     * @param LinkResolverInterface $linkResolver
     * @param NodeMapperInterface[] $mappers
     */
    public function __construct(LinkResolverInterface $linkResolver, array $mappers = [])
    {
        $this->linkResolver = $linkResolver;
        $this->mappers = \array_merge($this->createMappers(), $mappers);
    }

    /**
     * {@inheritdoc}
     */
    public function parse(array $data): NodeInterface
    {
        $nodeType = $data['nodeType'];
        if (!isset($this->mappers[$nodeType])) {
            throw new \InvalidArgumentException(\sprintf(
                'Unrecognized node type "%s" when trying to parse structured text.',
                $data['nodeType']
            ));
        }

        $mapper = $this->mappers[$nodeType];

        return $mapper->map($this, $this->linkResolver, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function parseCollection(array $data): array
    {
        return \array_map([$this, 'parse'], $data);
    }

    /**
     * @return NodeMapperInterface[]
     */
    private function createMappers(): array
    {
        return [
            Node\AssetHyperlink::getType() => new NodeMapper\AssetHyperlink(),
            Node\Document::getType() => new NodeMapper\Document(),
            Node\EmbeddedEntryBlock::getType() => new NodeMapper\EmbeddedEntryBlock(),
            Node\EntryHyperlink::getType() => new NodeMapper\EntryHyperlink(),
            Node\Heading1::getType() => new NodeMapper\Heading1(),
            Node\Heading2::getType() => new NodeMapper\Heading2(),
            Node\Heading3::getType() => new NodeMapper\Heading3(),
            Node\Heading4::getType() => new NodeMapper\Heading4(),
            Node\Heading5::getType() => new NodeMapper\Heading5(),
            Node\Heading6::getType() => new NodeMapper\Heading6(),
            Node\Hr::getType() => new NodeMapper\Hr(),
            Node\Hyperlink::getType() => new NodeMapper\Hyperlink(),
            Node\ListItem::getType() => new NodeMapper\ListItem(),
            Node\OrderedList::getType() => new NodeMapper\OrderedList(),
            Node\Paragraph::getType() => new NodeMapper\Paragraph(),
            Node\Quote::getType() => new NodeMapper\Quote(),
            Node\Text::getType() => new NodeMapper\Text(),
            Node\UnorderedList::getType() => new NodeMapper\UnorderedList(),
        ];
    }
}
