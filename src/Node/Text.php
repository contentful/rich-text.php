<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2025 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Node;

use Contentful\RichText\Mark\MarkInterface;

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
     * @param MarkInterface[] $marks
     */
    public function __construct(string $value, array $marks = [])
    {
        parent::__construct([]);
        $this->value = $value;
        $this->marks = $marks;
    }

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

    public static function getType(): string
    {
        return 'text';
    }

    public function jsonSerialize(): array
    {
        return [
            'nodeType' => self::getType(),
            'value' => $this->value,
            'marks' => $this->marks,
            'content' => $this->content,
        ];
    }
}
