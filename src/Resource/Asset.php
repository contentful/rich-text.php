<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Resource;

use Contentful\Core\Api\Link;
use Contentful\Core\Resource\AssetInterface;

/**
 * Asset class.
 *
 * This class works as an empty representation of an Asset,
 * to be used when resolving a link fails.
 */
class Asset implements AssetInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * Asset constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'Asset';
    }

    /**
     * {@inheritdoc}
     */
    public function getSystemProperties()
    {
        throw new \RuntimeException('Can not resolve system properties from empty asset');
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'sys' => [
                'id' => $this->id,
                'type' => 'Asset',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function asLink(): Link
    {
        return new Link($this->id, 'Asset');
    }
}
