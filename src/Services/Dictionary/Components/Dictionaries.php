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
        return $this->makeRequest(Routes::DICTIONARY_LIST, Routes::METHOD_GET, $filter);
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
        return $this->makeRequest(Routes::DICTIONARY_CREATE, Routes::METHOD_POST, $handler);
    }

    /**
     * Update dictionary  entry.
     * (!) Requires grant access.
     *
     * @param $id
     * @param DictionaryHandler $handler
     *
     * @return ViaResponse
     */
    public function update($id, DictionaryHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::DICTIONARY_UPDATE, ['{id}' => $id]), Routes::METHOD_PUT, $handler);
    }

    /**
     * Retrieve dictionary entry.
     * (!) Requires grant access.
     *
     * @param $id
     *
     * @return ViaResponse
     */
    public function retrieve($id): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::DICTIONARY_RETRIEVE, ['{id}' => $id]), Routes::METHOD_GET);
    }

    /**
     * Delete dictionary entry.
     * (!) Requires grant access.
     *
     * @param $id
     *
     * @return ViaResponse
     */
    public function delete($id): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::DICTIONARY_DELETE, ['{id}' => $id]), Routes::METHOD_DELETE);
    }

}