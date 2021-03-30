<?php

namespace ViaAPI\ViaSdkPhp\Traits;

use ViaAPI\ViaSdkPhp\Contracts\FilterInterface;
use ViaAPI\ViaSdkPhp\Trivia\Exception\ExceededLimitException;

trait HasFilter
{
    /** @var FilterInterface */
    public $filter;

    public function limited(int $limit): self
    {
        if ($limit > 200 )
            throw new ExceededLimitException(
                'Limit has been exceeded. You can make 200 records at single query.'
            );

        $this->filter->setLimit($limit);
        return $this;
    }

    public function skipping(int $limit): self
    {
        $this->filter->setOffset($limit);
        return $this;
    }
}