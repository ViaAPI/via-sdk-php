<?php

namespace ViaAPI\ViaSdkPhp\Services\Dictionary\Components;

use ViaAPI\ViaSdkPhp\Contracts\ComponentInterface;
use ViaAPI\ViaSdkPhp\Routes;
use ViaAPI\ViaSdkPhp\Services\Dictionary\DictionaryClient;
use ViaAPI\ViaSdkPhp\Services\Dictionary\Filters\DictionaryFilter;
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
}