<?php

/**
 * This file is part of the contentful/structured-text-renderer package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\StructuredText\Node;

use Contentful\StructuredText\Mark\MarkInterface;

class Text extends InlineNode
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var MarkInterface[]
     */
    private $marks;

    /**
     * Text constructor.
     *
     * @param string          $value
     * @param MarkInterface[] $marks
     */
    public function __construct(string $value, array $marks = [])
    {
        $this->value = $value;
        $this->marks = $marks;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return MarkInterface[]
     */
    public function getMarks(): array
    {
        return $this->marks;
    }

    /**
     * {@inheritdoc}
     */
    public static function getType(): string
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'value' => $this->value,
            'marks' => $this->marks,
        ];
    }
}
