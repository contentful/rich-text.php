<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\Core\Api\Link;
use Contentful\Core\Resource\EntryInterface;
use Contentful\Core\Resource\SystemPropertiesInterface;

/**
 * Basic implementation of EntryInterface for testing purposes.
 */
class Entry implements EntryInterface
{
    /**
     * @var SystemPropertiesInterface
     */
    private $sys;

    public function __construct(string $id)
    {
        $this->sys = new SystemProperties([
            'id' => $id,
            'type' => 'Entry',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->sys->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return $this->sys->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function asLink(): Link
    {
        return new Link(
            $this->getId(),
            $this->getType()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getSystemProperties(): SystemPropertiesInterface
    {
        return $this->sys;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'sys' => $this->sys,
        ];
    }
}
