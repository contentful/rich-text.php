<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2026 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\NodeRenderer;

use Contentful\RichText\Node\Hyperlink as NodeClass;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\RendererInterface;

class Hyperlink implements NodeRendererInterface
{
    public function supports(NodeInterface $node): bool
    {
        return $node instanceof NodeClass;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        /* @var NodeClass $node */
        if (!$node instanceof NodeClass) {
            throw new \LogicException(\sprintf('Trying to use node renderer "%s" to render unsupported node of class "%s".', static::class, $node::class));
        }

        return \sprintf(
            '<a href="%s" title="%s">%s</a>',
            $this->sanitizeUri($node->getUri()),
            \htmlspecialchars($node->getTitle(), \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8'),
            $renderer->renderCollection($node->getContent(), $context)
        );
    }

    /**
     * Returns an HTML-safe href value, blocking any scheme other than http(s).
     *
     * Control characters and whitespace are stripped before scheme detection
     * because browsers ignore them when resolving a URL (e.g. "java\tscript:"),
     * so leaving them in would let \parse_url() report an empty scheme and wave
     * a dangerous URI through.
     */
    private function sanitizeUri(string $uri): string
    {
        $normalized = \preg_replace('/[\x00-\x20\x7f]+/', '', $uri) ?? '';
        $scheme = \strtolower((string) \parse_url($normalized, \PHP_URL_SCHEME));

        if (!\in_array($scheme, ['https', 'http', ''], true)) {
            return '#';
        }

        return \htmlspecialchars($normalized, \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8');
    }
}
