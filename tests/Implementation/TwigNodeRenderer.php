<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2024 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\NodeRenderer\NodeRendererInterface;
use Contentful\RichText\RendererInterface;
use Twig\Environment;

/**
 * Basic implementation of NodeRendererInterface for testing purposes.
 *
 * This implementation demonstrates how delegating
 * to an actual templating engine might work.
 */
class TwigNodeRenderer implements NodeRendererInterface
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function supports(NodeInterface $node): bool
    {
        return true;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        $template = $this->twig
            ->createTemplate('This is a node with type "{{ name }}" with context var set to "{{ contextVar }}".')
        ;

        return $template->render([
            'name' => $node->getType(),
            'contextVar' => $context['contextVar'],
        ]);
    }
}
