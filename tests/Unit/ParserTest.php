<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Unit;

use Contentful\StructuredText\Node as NodeClass;
use Contentful\StructuredText\Parser;
use Contentful\Tests\StructuredText\Implementation\LinkResolver;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\Implementation\NodeMapper;
use Contentful\Tests\StructuredText\TestCase;

class ParserTest extends TestCase
{
    public function testParserOutput()
    {
        $parser = new Parser(new LinkResolver(), [
            'custom-node' => new NodeMapper(),
        ]);

        /** @var Node $node */
        $node = $parser->parse($this->getParsedFixture('custom-node.json'));

        $this->assertInstanceOf(Node::class, $node);
        $this->assertSame('Node value', $node->getValue());
    }

    /**
     * @dataProvider provideNodes
     *
     * @param string $file
     * @param string $class
     */
    public function testParseNode(string $file, string $class)
    {
        $parser = new Parser(new LinkResolver());

        $node = $parser->parse($this->getParsedFixture($file.'.json'));

        $this->assertInstanceOf($class, $node);

        $this->assertJsonFixtureEqualsJsonObject($file.'.json', $node);
    }

    public function provideNodes(): array
    {
        return [
            ['asset-hyperlink', NodeClass\AssetHyperlink::class],
            ['document', NodeClass\Document::class],
            ['embedded-entry-block', NodeClass\EmbeddedEntryBlock::class],
            ['entry-hyperlink', NodeClass\EntryHyperlink::class],
            ['heading-1', NodeClass\Heading1::class],
            ['heading-2', NodeClass\Heading2::class],
            ['heading-3', NodeClass\Heading3::class],
            ['heading-4', NodeClass\Heading4::class],
            ['heading-5', NodeClass\Heading5::class],
            ['heading-6', NodeClass\Heading6::class],
            ['hr', NodeClass\Hr::class],
            ['hyperlink', NodeClass\Hyperlink::class],
            ['list-item', NodeClass\ListItem::class],
            ['ordered-list', NodeClass\OrderedList::class],
            ['paragraph', NodeClass\Paragraph::class],
            ['quote', NodeClass\Quote::class],
            ['text', NodeClass\Text::class],
            ['unordered-list', NodeClass\UnorderedList::class],
        ];
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Unrecognized node type "invalid-node" when trying to parse structured text
     */
    public function testInvalidNode()
    {
        $parser = new Parser(new LinkResolver());

        $parser->parse($this->getParsedFixture('invalid-node.json'));
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Unrecognized mark type "invalid-mark" when trying to parse structured text
     */
    public function testInvalidMark()
    {
        $parser = new Parser(new LinkResolver());

        $parser->parse($this->getParsedFixture('invalid-mark.json'));
    }
}
