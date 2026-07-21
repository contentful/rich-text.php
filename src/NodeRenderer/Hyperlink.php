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
            htmlspecialchars($node->getTitle(), \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8'),
            $renderer->renderCollection($node->getContent(), $context)
        );
    }

    /**
     * Allow-list of URI schemes safe to emit as an href. Relative and
     * fragment-only URIs (which carry no scheme) are also permitted.
     */
    private const ALLOWED_SCHEMES = ['https', 'http', 'mailto', 'tel'];

    /**
     * Returns an HTML-safe href value, blocking any scheme outside the
     * allow-list as well as protocol-relative URIs.
     *
     * Control characters and whitespace are stripped before scheme detection
     * because browsers ignore them when resolving a URL (e.g. "java\tscript:"),
     * so leaving them in would let a dangerous URI slip through.
     */
    private function sanitizeUri(string $uri): string
    {
        $normalized = preg_replace('/[\x00-\x20\x7f]+/', '', $uri) ?? '';

        // Reject protocol-relative URIs ("//evil.com/..."). They carry no
        // scheme, so they'd otherwise pass the allow-list as a scheme-less
        // relative URI, giving an open-redirect / phishing vector.
        if (str_starts_with($normalized, '//')) {
            return '#';
        }

        // Match the scheme directly rather than delegating to parse_url(),
        // which returns false/null on malformed input — both coerce to an
        // empty ("safe") scheme and would wave a crafted URI through.
        if (preg_match('/^([a-zA-Z][a-zA-Z0-9+.\-]*):/', $normalized, $matches)
            && !\in_array(mb_strtolower($matches[1]), self::ALLOWED_SCHEMES, true)) {
            return '#';
        }

        return htmlspecialchars($normalized, \ENT_QUOTES | \ENT_SUBSTITUTE, 'UTF-8');
    }
}
