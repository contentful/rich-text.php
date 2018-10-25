<?php

/**
 * This file is part of the contentful/rich-text package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

declare(strict_types=1);

namespace Contentful\RichText\Exception;

class MapperException extends \Exception
{
    /**
     * @var array
     */
    private $data;

    /**
     * MapperException constructor.
     *
     * @param array           $data
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct(array $data, string $message = '', int $code = 0, \Throwable $previous = \null)
    {
        parent::__construct($message, $code, $previous);

        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
