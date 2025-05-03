<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Bridge;

use Contentful\RichText\Renderer;
use Contentful\RichText\RendererInterface;
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
     */
    public function __construct(?RendererInterface $renderer = null)
    {
        $this->renderer = $renderer ?: new Renderer();
    }

    public function getFunctions()
    {
        return [
            new TwigFunction(
                'rich_text_render',
                [$this->renderer, 'render'],
                ['is_safe' => ['html']]
            ),
            new TwigFunction(
                'rich_text_render_collection',
                [$this->renderer, 'renderCollection'],
                ['is_safe' => ['html']]
            ),
        ];
    }
}
