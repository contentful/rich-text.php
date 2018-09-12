<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText;

use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\NodeRenderer\NodeRendererInterface;

class Renderer implements RendererInterface
{
    /**
     * @var NodeRendererInterface[]
     */
    private $nodeRenderers;

    /**
     * Renderer constructor.
     *
     * @param NodeRendererInterface[] $nodeRenderers
     */
    public function __construct(array $nodeRenderers = [])
    {
        $this->nodeRenderers = $this->createNodeRenderers();

        foreach ($nodeRenderers as $nodeRenderer) {
            $this->pushNodeRenderer($nodeRenderer);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function render(NodeInterface $node, array $context = []): string
    {
        foreach ($this->nodeRenderers as $renderer) {
            if ($renderer->supports($node)) {
                return $renderer->render($this, $node, $context);
            }
        }

        throw new \InvalidArgumentException(\sprintf(
            'Structured text renderer could not find NodeRenderer instance which supports node of class "%s".',
            \get_class($node)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function renderCollection(array $nodes, array $context = []): string
    {
        return \implode('', \array_map(function (NodeInterface $node) use ($context): string {
            return $this->render($node, $context);
        }, $nodes));
    }

    /**
     * Adds a custom node renderer to the current stack.
     * The renderer will be added to the beginning of the list,
     * so those renderers added last will have higher priority over default ones.
     *
     * @param NodeRendererInterface $renderer
     *
     * @return $this
     */
    public function pushNodeRenderer(NodeRendererInterface $renderer)
    {
        \array_unshift($this->nodeRenderers, $renderer);

        return $this;
    }

    /**
     * @return NodeRendererInterface[]
     */
    public function getNodeRenderers(): array
    {
        return $this->nodeRenderers;
    }

    /**
     * Creates a list of default node renderers.
     *
     * @return NodeRendererInterface[]
     */
    private function createNodeRenderers(): array
    {
        return [
            new NodeRenderer\AssetHyperlink(),
            new NodeRenderer\Document(),
            new NodeRenderer\EmbeddedEntryBlock(),
            new NodeRenderer\EntryHyperlink(),
            new NodeRenderer\Heading1(),
            new NodeRenderer\Heading2(),
            new NodeRenderer\Heading3(),
            new NodeRenderer\Heading4(),
            new NodeRenderer\Heading5(),
            new NodeRenderer\Heading6(),
            new NodeRenderer\Hr(),
            new NodeRenderer\Hyperlink(),
            new NodeRenderer\ListItem(),
            new NodeRenderer\OrderedList(),
            new NodeRenderer\Paragraph(),
            new NodeRenderer\Quote(),
            new NodeRenderer\Text(),
            new NodeRenderer\UnorderedList(),
        ];
    }
}
