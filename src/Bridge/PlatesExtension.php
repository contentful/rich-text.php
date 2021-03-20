<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
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
    public function __construct(RendererInterface $renderer = null)
    {
        $this->renderer = $renderer ?: new Renderer();
    }

    /**
     * {@inheritdoc}
     */
    public function register(Engine $engine)
    {
        // The type annotations here make no sense.
        // But they are needed to trick static analysis with PHPStan,
        // as Plates wrongly defines the PHPDoc type of the second
        // parameter of Engine::registerFunction() as "callback" (instead of callable),
        // which does not exist and is resolved as the non-existent
        // League\Plates\callback class ¯\_(ツ)_/¯

        /** @var \League\Plates\callback $callback */
        $callback = [$this->renderer, 'render'];
        $engine->registerFunction('richTextRender', $callback);

        /** @var \League\Plates\callback $callback */
        $callback = [$this->renderer, 'renderCollection'];
        $engine->registerFunction('richTextRenderCollection', $callback);
    }
}
