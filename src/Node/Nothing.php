<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2021 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

class Nothing implements NodeInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * Nothing constructor.
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'nothing';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
