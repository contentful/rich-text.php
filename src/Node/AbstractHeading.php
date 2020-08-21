<?php

namespace Contentful\RichText\Node;

abstract class AbstractHeading extends BlockNode
{
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'nodeType' => static::getType(),
            'content' => $this->content,
            'data' => new \stdClass(),
        ];
    }
}
