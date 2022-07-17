<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2022 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Integration;

use Contentful\Core\ResourceBuilder\ObjectHydrator;
use Contentful\RichText\Node\NodeInterface;
use Contentful\RichText\NodeRenderer\NodeRendererInterface;
use Contentful\RichText\Renderer;
use Contentful\Tests\RichText\Implementation\Node;
use Contentful\Tests\RichText\TestCase;
use Symfony\Component\Finder\Finder;

class AllNodesHaveRendererTest extends TestCase
{
    /**
     * @var NodeRendererInterface[]
     */
    private $allNodeRenderers = [];

    /**
     * @var NodeRendererInterface[]
     */
    private $defaultNodeRenderers = [];

    protected function setUp(): void
    {
        // This loads all available node renderers
        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->in(__DIR__.'/../../src/NodeRenderer')
        ;

        foreach ($iterator as $file) {
            if ('Interface.php' === mb_substr($file->getFilename(), -13)) {
                continue;
            }

            $nodeRendererClass = str_replace('.php', '', $file->getRelativePathname());
            $fqcn = '\\Contentful\\RichText\\NodeRenderer\\'.$nodeRendererClass;

            $this->allNodeRenderers[$nodeRendererClass] = new $fqcn();
        }

        $this->defaultNodeRenderers = (new Renderer())
            ->getNodeRenderers()
        ;
    }

    /**
     * @dataProvider classFileProvider
     */
    public function testAllNodesHaveRenderer(string $class)
    {
        $nodeClass = '\\Contentful\\RichText\\Node\\'.$class;
        $nodeRendererClass = '\\Contentful\\RichText\\NodeRenderer\\'.$class;

        $reflection = new \ReflectionClass($nodeClass);
        if ($reflection->isAbstract() || $reflection->isInterface()) {
            $this->markTestAsPassed();

            return;
        }

        if (!class_exists($nodeRendererClass)) {
            $this->fail(sprintf(
                'Node renderer "%s" does not exists',
                $nodeRendererClass
            ));
        }

        $hydrator = new ObjectHydrator();
        /** @var NodeInterface $node */
        $node = $hydrator->hydrate($nodeClass, []);
        foreach ($this->allNodeRenderers as $nodeRenderer) {
            if ($nodeRenderer->supports($node)) {
                $this->markTestAsPassed();

                return;
            }
        }

        $this->fail(sprintf(
            'No node renderer which supports node of class "%s" was found.',
            $nodeClass
        ));
    }

    /**
     * @dataProvider classFileProvider
     */
    public function testMainRendererCreatesAllNodeRenderers(string $class)
    {
        $nodeClass = '\\Contentful\\RichText\\Node\\'.$class;

        $reflection = new \ReflectionClass($nodeClass);
        if ($reflection->isAbstract() || $reflection->isInterface()) {
            $this->markTestAsPassed();

            return;
        }

        $hydrator = new ObjectHydrator();
        /** @var NodeInterface $node */
        $node = $hydrator->hydrate($nodeClass, []);
        foreach ($this->defaultNodeRenderers as $nodeRenderer) {
            if ($nodeRenderer->supports($node)) {
                $this->markTestAsPassed();

                return;
            }
        }

        $this->fail(sprintf(
            'No default node renderer which supports node of class "%s" was found.',
            $nodeClass
        ));
    }

    public function classFileProvider()
    {
        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->in(__DIR__.'/../../src/Node')
        ;

        foreach ($iterator as $file) {
            if ('Interface.php' === mb_substr($file->getFilename(), -13)) {
                continue;
            }

            yield $file->getFilename() => [str_replace('.php', '', $file->getRelativePathname())];
        }
    }
}
