<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Integration;

use Contentful\Core\ResourceBuilder\ObjectHydrator;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\StructuredText\NodeRenderer\NodeRendererInterface;
use Contentful\StructuredText\Renderer;
use Contentful\Tests\StructuredText\Implementation\Node;
use Contentful\Tests\StructuredText\TestCase;
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

    public function setUp()
    {
        // This loads all available node renderers
        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->in(__DIR__.'/../../src/NodeRenderer')
        ;

        foreach ($iterator as $file) {
            if ('Interface.php' === \mb_substr($file->getFilename(), -13)) {
                continue;
            }

            $nodeRendererClass = \str_replace('.php', '', $file->getRelativePathname());
            $fqcn = '\\Contentful\\StructuredText\\NodeRenderer\\'.$nodeRendererClass;

            $this->allNodeRenderers[$nodeRendererClass] = new $fqcn();
        }

        $this->defaultNodeRenderers = (new Renderer())
            ->getNodeRenderers()
        ;
    }

    /**
     * @dataProvider classFileProvider
     *
     * @param string $class
     */
    public function testAllNodesHaveRenderer(string $class)
    {
        $nodeClass = '\\Contentful\\StructuredText\\Node\\'.$class;
        $nodeRendererClass = '\\Contentful\\StructuredText\\NodeRenderer\\'.$class;

        $reflection = new \ReflectionClass($nodeClass);
        if ($reflection->isAbstract() || $reflection->isInterface()) {
            $this->markTestAsPassed();

            return;
        }

        if (!\class_exists($nodeRendererClass)) {
            $this->fail(\sprintf(
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

        $this->fail(\sprintf(
            'No node renderer which supports node of class "%s" was found.',
            $nodeClass
        ));
    }

    /**
     * @dataProvider classFileProvider
     *
     * @param string $class
     */
    public function testMainRendererCreatesAllNodeRenderers(string $class)
    {
        $nodeClass = '\\Contentful\\StructuredText\\Node\\'.$class;

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

        $this->fail(\sprintf(
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
            if ('Interface.php' === \mb_substr($file->getFilename(), -13)) {
                continue;
            }

            yield $file->getFilename() => [\str_replace('.php', '', $file->getRelativePathname())];
        }
    }
}
