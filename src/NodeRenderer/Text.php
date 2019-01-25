<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Mark\MarkInterface;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\Node\Text as NodeClass;
use Contentful\RichText\RendererInterface;

class Text implements NodeRendererInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(NodeInterface $node): bool
    {
        return $node instanceof NodeClass;
    }

    /**
     * {@inheritdoc}
     */
    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        /* @var NodeClass $node */
        if (!$node instanceof NodeClass) {
            throw new \LogicException(\sprintf(
                'Trying to use node renderer "%s" to render unsupported node of class "%s".',
                \get_class($this),
                \get_class($node)
            ));
        }

        return \array_reduce($node->getMarks(), function (string $value, MarkInterface $mark) {
            $tag = $this->getHtmlTagForMark($mark);

            return \sprintf('<%s>%s</%s>', $tag, $value, $tag);
        }, $node->getValue());
    }

    /**
     * @param MarkInterface $mark
     *
     * @return string
     */
    private function getHtmlTagForMark(MarkInterface $mark): string
    {
        $type = $mark->getType();
        $tags = [
            'bold' => 'strong',
            'code' => 'code',
            'italic' => 'em',
            'underline' => 'u',
        ];

        return $tags[$type] ?? 'span';
    }
}
