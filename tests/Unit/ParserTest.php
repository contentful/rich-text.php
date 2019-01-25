<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit;

use Contentful\RichText\Node as NodeClass;
use Contentful\RichText\Parser;
use Contentful\Tests\RichText\Implementation\FailingLinkResolver;
use Contentful\Tests\RichText\Implementation\LinkResolver;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\Implementation\NodeMapper;
use Contentful\Tests\RichText\TestCase;

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
            ['blockquote', NodeClass\Blockquote::class],
            ['document', NodeClass\Document::class],
            ['embedded-asset-block', NodeClass\EmbeddedAssetBlock::class],
            ['embedded-asset-inline', NodeClass\EmbeddedAssetInline::class],
            ['embedded-entry-block', NodeClass\EmbeddedEntryBlock::class],
            ['embedded-entry-inline', NodeClass\EmbeddedEntryInline::class],
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
            ['text', NodeClass\Text::class],
            ['unordered-list', NodeClass\UnorderedList::class],
        ];
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Unrecognized node type "invalid-node" when trying to parse rich text
     */
    public function testInvalidNode()
    {
        $parser = new Parser(new LinkResolver());

        $parser->parse($this->getParsedFixture('invalid-node.json'));
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Unrecognized mark type "invalid-mark" when trying to parse rich text
     */
    public function testInvalidMark()
    {
        $parser = new Parser(new LinkResolver());

        $parser->parse($this->getParsedFixture('invalid-mark.json'));
    }

    /**
     * @dataProvider provideInvalidLinkNodes
     *
     * @param string $file
     */
    public function testMapperException(string $file)
    {
        $parser = new Parser(new FailingLinkResolver());

        $node = $parser->parse($this->getParsedFixture($file.'.json'));

        $this->assertInstanceOf(NodeClass\Nothing::class, $node);

        $this->assertJsonFixtureEqualsJsonObject($file.'.json', $node);
    }

    public function provideInvalidLinkNodes(): array
    {
        return [
            ['asset-hyperlink'],
            ['embedded-asset-block'],
            ['embedded-asset-inline'],
            ['embedded-entry-block'],
            ['embedded-entry-inline'],
            ['entry-hyperlink'],
        ];
    }

    public function testCustomMapper()
    {
        $parser = new Parser(new LinkResolver());

        $parser->setNodeMapper('custom-node', new NodeMapper());

        /** @var Node $node */
        $node = $parser->parse($this->getParsedFixture('custom-node.json'));

        $this->assertInstanceOf(Node::class, $node);
        $this->assertSame('Node value', $node->getValue());
    }
}
