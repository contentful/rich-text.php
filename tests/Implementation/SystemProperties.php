<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\Core\Resource\SystemPropertiesInterface;

/**
 * Basic implementation of SystemPropertiesInterface for testing purposes.
 */
class SystemProperties implements SystemPropertiesInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
        ];
    }
}
