<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\Tests\RichText\Implementation;

use Contentful\RichText\Node\NodeInterface;

/**
 * Basic implementation of NodeInterface for testing purposes.
 */
class Node implements NodeInterface
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function getType(): string
    {
        return 'node';
    }

    public function getNodeClass(): string
    {
        return 'block';
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
        ];
    }
}
