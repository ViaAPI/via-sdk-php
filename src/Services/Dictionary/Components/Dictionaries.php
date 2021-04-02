<?php

namespace ViaAPI\ViaSdkPhp\Services\Dictionary\Components;

use ViaAPI\ViaSdkPhp\Contracts\ComponentInterface;
use ViaAPI\ViaSdkPhp\Routes;
use ViaAPI\ViaSdkPhp\Services\Dictionary\DictionaryClient;
use ViaAPI\ViaSdkPhp\Services\Dictionary\Filters\DictionaryFilter;
use ViaAPI\ViaSdkPhp\Services\Dictionary\Handlers\DictionaryHandler;
use ViaAPI\ViaSdkPhp\Traits\HasFilter;
use ViaAPI\ViaSdkPhp\ViaResponse;

class Dictionaries extends DictionaryClient implements ComponentInterface
{
    use HasFilter;

    /**
     * A list of dictionary records.
     *
     * @param DictionaryFilter|null $filter
     *
     * @return ViaResponse
     */
    public function list(?DictionaryFilter $filter = null): ViaResponse
    {
        $filter = $filter ?? new DictionaryFilter();
        return $this->makeRequest(Routes::DICTIONARY_LIST, 'GET', $filter);
    }

    /**
     * Insert dictionary  entry.
     * (!) Requires grant access.
     *
     * @param DictionaryHandler $handler
     *
     * @return ViaResponse
     */
    public function insert(DictionaryHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::DICTIONARY_CREATE, 'POST', $handler);
    }


}