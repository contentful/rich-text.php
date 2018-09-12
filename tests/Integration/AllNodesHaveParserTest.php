<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText\Integration;

use Contentful\StructuredText\NodeMapper\NodeMapperInterface;
use Contentful\StructuredText\Parser;
use Contentful\Tests\StructuredText\Implementation\LinkResolver;
use Contentful\Tests\StructuredText\TestCase;
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
        $property->setAccessible(\true);

        $this->mappers = $property->getValue($parser);
    }

    /**
     * @dataProvider classFileProvider
     *
     * @param string $file
     */
    public function testAllNodesHaveParser($file)
    {
        $file = \str_replace('.php', '', $file);
        $nodeClass = '\\Contentful\\StructuredText\\Node\\'.$file;
        $nodeMapperClass = '\\Contentful\\StructuredText\\NodeMapper\\'.$file;

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
            if ('Interface.php' === \mb_substr($file->getFilename(), -13)) {
                continue;
            }

            yield $file->getFilename() => [$file->getRelativePathname()];
        }
    }
}
