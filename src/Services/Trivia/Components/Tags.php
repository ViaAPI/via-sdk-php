<?php

namespace ViaAPI\ViaSdkPhp\Services\Trivia\Components;

use ViaAPI\ViaSdkPhp\Contracts\ComponentInterface;
use ViaAPI\ViaSdkPhp\Routes;
use ViaAPI\ViaSdkPhp\Services\Trivia\Filters\TagFilter;
use ViaAPI\ViaSdkPhp\Services\Trivia\TriviaClient;
use ViaAPI\ViaSdkPhp\Traits\HasFilter;
use ViaAPI\ViaSdkPhp\ViaResponse;
use GuzzleHttp\Exception\GuzzleException;

class Tags extends TriviaClient implements ComponentInterface
{
    use HasFilter;

    /**
     * A list of trivia tags.
     *
     * @param TagFilter|null $filter
     *
     * @return ViaResponse
     */
    public function list(?TagFilter $filter = null): ViaResponse
    {
        $filter = $filter ?? new TagFilter();
        return $this->makeRequest(Routes::TAG_LIST, 'GET', $filter);
    }

}