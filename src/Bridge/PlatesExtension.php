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
use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class PlatesExtension implements ExtensionInterface
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * PlatesExtension constructor.
     */
    public function __construct(?RendererInterface $renderer = null)
    {
        $this->renderer = $renderer ?: new Renderer();
    }

    public function register(Engine $engine)
    {
        $callback = [$this->renderer, 'render'];
        $engine->registerFunction('richTextRender', $callback);

        $callback = [$this->renderer, 'renderCollection'];
        $engine->registerFunction('richTextRenderCollection', $callback);
    }
}
