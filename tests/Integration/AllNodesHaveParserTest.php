<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2019 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Integration;

use Contentful\RichText\NodeMapper\NodeMapperInterface;
use Contentful\RichText\Parser;
use Contentful\Tests\RichText\Implementation\LinkResolver;
use Contentful\Tests\RichText\TestCase;
use Symfony\Component\Finder\Finder;

class AllNodesHaveParserTest extends TestCase
{
    /**
     * @var NodeMapperInterface[]
     */
    private $mappers;

    public function setUp()
    {
        $parser = new Parser(new LinkResolver());

        $object = new \ReflectionObject($parser);
        $property = $object->getProperty('mappers');
        $property->setAccessible(true);

        $this->mappers = $property->getValue($parser);
    }

    /**
     * @dataProvider classFileProvider
     */
    public function testAllNodesHaveParser(string $file)
    {
        $file = \str_replace('.php', '', $file);
        $nodeClass = '\\Contentful\\RichText\\Node\\'.$file;
        $nodeMapperClass = '\\Contentful\\RichText\\NodeMapper\\'.$file;

        $reflection = new \ReflectionClass($nodeClass);
        if ($reflection->isAbstract() || $reflection->isInterface()) {
            $this->markTestAsPassed();

            return;
        }

        if (!\class_exists($nodeMapperClass)) {
            $this->fail(\sprintf(
                'Node mapper "%s" does not exists',
                $nodeMapperClass
            ));
        }

        $nodeType = \call_user_func([$nodeClass, 'getType']);
        $this->assertArrayHasKey($nodeType, $this->mappers);
        $this->assertInstanceOf($nodeMapperClass, $this->mappers[$nodeType]);
    }

    public function classFileProvider()
    {
        $iterator = Finder::create()
            ->files()
            ->name('*.php')
            ->in(__DIR__.'/../../src/Node')
        ;

        foreach ($iterator as $file) {
            yield $file->getFilename() => [$file->getRelativePathname()];
        }
    }
}
