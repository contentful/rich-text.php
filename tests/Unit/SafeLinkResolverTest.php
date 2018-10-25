<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Unit;

use Contentful\Core\Api\Link;
use Contentful\Core\Resource\AssetInterface;
use Contentful\Core\Resource\EntryInterface;
use Contentful\RichText\Resource\Asset;
use Contentful\RichText\Resource\Entry;
use Contentful\RichText\SafeLinkResolver;
use Contentful\Tests\RichText\Implementation\FailingLinkResolver;
use Contentful\Tests\RichText\TestCase;

class SafeLinkResolverTest extends TestCase
{
    public function testLinksAreAlwaysResolved()
    {
        $linkResolver = new SafeLinkResolver(new FailingLinkResolver());

        $entry = $linkResolver->resolveLink(new Link('entryId', 'Entry'));
        $this->assertInstanceOf(EntryInterface::class, $entry);
        $this->assertInstanceOf(Entry::class, $entry);
        $this->assertSame('entryId', $entry->getId());
        $this->assertSame('Entry', $entry->getType());

        try {
            $entry->getSystemProperties();

            $this->fail('Accessing system properties of an empty entry did not throw an exception');
        } catch (\RuntimeException $exception) {
            $this->assertSame('Can not resolve system properties from empty entry', $exception->getMessage());
        }

        $this->assertJsonFixtureEqualsJsonObject('entry.json', $entry);
        $this->assertLink('entryId', 'Entry', $entry->asLink());

        $asset = $linkResolver->resolveLink(new Link('assetId', 'Asset'));
        $this->assertInstanceOf(AssetInterface::class, $asset);
        $this->assertInstanceOf(Asset::class, $asset);
        $this->assertSame('assetId', $asset->getId());
        $this->assertSame('Asset', $asset->getType());

        try {
            $asset->getSystemProperties();

            $this->fail('Accessing system properties of an empty asset did not throw an exception');
        } catch (\RuntimeException $exception) {
            $this->assertSame('Can not resolve system properties from empty asset', $exception->getMessage());
        }

        $this->assertJsonFixtureEqualsJsonObject('asset.json', $asset);
        $this->assertLink('assetId', 'Asset', $asset->asLink());
    }
}
