<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Bridge;

use Contentful\StructuredText\Renderer;
use Contentful\StructuredText\RendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * TwigExtension constructor.
     *
     * @param RendererInterface|null $renderer
     */
    public function __construct(RendererInterface $renderer = \null)
    {
        $this->renderer = $renderer ?: new Renderer();
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'structured_text_render',
                [$this->renderer, 'render'],
                ['is_safe' => ['html']]
            ),
            new TwigFunction(
                'structured_text_render_collection',
                [$this->renderer, 'renderCollection'],
                ['is_safe' => ['html']]
            ),
        ];
    }
}
