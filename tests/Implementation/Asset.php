<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\Core\Api\Link;
use Contentful\Core\Resource\AssetInterface;
use Contentful\Core\Resource\SystemPropertiesInterface;

/**
 * Basic implementation of AssetInterface for testing purposes.
 */
class Asset implements AssetInterface
{
    /**
     * @var SystemPropertiesInterface
     */
    private $sys;

    public function __construct(string $id)
    {
        $this->sys = new SystemProperties([
            'id' => $id,
            'type' => 'Asset',
        ]);
    }

    public function getId(): string
    {
        return $this->sys->getId();
    }

    public function getType(): string
    {
        return $this->sys->getType();
    }

    public function asLink(): Link
    {
        return new Link(
            $this->getId(),
            $this->getType()
        );
    }

    public function getSystemProperties(): SystemPropertiesInterface
    {
        return $this->sys;
    }

    public function jsonSerialize(): array
    {
        return [
            'sys' => $this->sys,
        ];
    }
}
