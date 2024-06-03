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
use League\Plates\Engine;

/**
 * Basic implementation of NodeRendererInterface for testing purposes.
 *
 * This implementation demonstrates how delegating
 * to an actual templating engine might work.
 */
class PlatesNodeRenderer implements NodeRendererInterface
{
    /**
     * @var Engine
     */
    private $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function supports(NodeInterface $node): bool
    {
        return true;
    }

    public function render(RendererInterface $renderer, NodeInterface $node, array $context = []): string
    {
        return $this->plates->render('template', [
            'name' => $node->getType(),
            'contextVar' => $context['contextVar'],
        ]);
    }
}
