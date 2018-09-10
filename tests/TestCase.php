<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\StructuredText;

use Contentful\StructuredText\Mark\MarkInterface;
use Contentful\StructuredText\Node\NodeInterface;
use Contentful\Tests\StructuredText\Implementation\Mark;
use Contentful\Tests\StructuredText\Implementation\Node;
use PHPUnit\Framework\TestCase as BaseTestCase;
use function GuzzleHttp\json_decode as guzzle_json_decode;

class TestCase extends BaseTestCase
{
    /**
     * Creates an empty assertion (true == true).
     * This is done to mark tests that are expected to simply work (i.e. not throw exceptions).
     * As PHPUnit does not provide convenience methods for marking a test as passed,
     * we define one.
     */
    protected function markTestAsPassed()
    {
        $this->assertTrue(\true, 'Test case did not throw an exception and passed.');
    }

    /**
     * @param string $file
     * @param object $object
     * @param string $message
     */
    protected function assertJsonFixtureEqualsJsonObject(string $file, $object, string $message = '')
    {
        $dir = $this->convertClassToFixturePath(\debug_backtrace()[1]['class']);
        $this->assertJsonStringEqualsJsonFile($dir.'/'.$file, \GuzzleHttp\json_encode($object), $message);
    }

    /**
     * @param string $file
     * @param string $string
     * @param string $message
     */
    protected function assertJsonFixtureEqualsJsonString(string $file, string $string, string $message = '')
    {
        $dir = $this->convertClassToFixturePath(\debug_backtrace()[1]['class']);
        $this->assertJsonStringEqualsJsonFile($dir.'/'.$file, $string, $message);
    }

    /**
     * @param string $file
     *
     * @return string
     */
    protected function getFixtureContent(string $file)
    {
        $dir = $this->convertClassToFixturePath(\debug_backtrace()[1]['class']);

        return \file_get_contents($dir.'/'.$file);
    }

    protected function getParsedFixture(string $file)
    {
        $dir = $this->convertClassToFixturePath(\debug_backtrace()[1]['class']);

        return guzzle_json_decode(\file_get_contents($dir.'/'.$file), \true);
    }

    /**
     * This automatically determined where to store the fixture according to the test name.
     * For instance, it will convert a the class
     * Contentful\Tests\Delivery\Unit\SystemPropertiesTest
     * to __DIR__.'/Fixtures/Unit/SystemProperties/'.$file.
     *
     * @param string $class
     *
     * @return string
     */
    private function convertClassToFixturePath(string $class)
    {
        $class = \str_replace(__NAMESPACE__.'\\', '', $class);
        $class = \str_replace('\\', '/', $class);
        $class = \mb_substr($class, 0, -4);

        return __DIR__.'/Fixtures/'.$class;
    }

    /**
     * @param int $amount
     *
     * @return NodeInterface[]
     */
    protected function createNodes(int $amount = 5): array
    {
        $nodes = [];
        while ($amount) {
            $nodes[] = new Node(\bin2hex(\random_bytes(5)));
            --$amount;
        }

        return $nodes;
    }

    /**
     * @param int $amount
     *
     * @return MarkInterface[]
     */
    protected function createMarks(int $amount = 5): array
    {
        $nodes = [];
        while ($amount) {
            $nodes[] = new Mark();
            --$amount;
        }

        return $nodes;
    }
}
