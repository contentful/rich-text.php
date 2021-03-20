<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\Core\Api\Link;
use Contentful\Core\Api\LinkResolverInterface;
use Contentful\Core\Resource\ResourceInterface;

/**
 * Basic implementation of a failing LinkResolverInterface for testing purposes.
 */
class FailingLinkResolver implements LinkResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolveLink(Link $link, array $parameters = []): ResourceInterface
    {
        throw new \Exception('test exception');
    }

    /**
     * {@inheritdoc}
     */
    public function resolveLinkCollection(array $links, array $parameters = []): array
    {
        throw new \Exception('test exception');
    }
}
