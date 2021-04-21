<?php

namespace ViaAPI\ViaSdkPhp\Services\Trivia\Components;

use ViaAPI\ViaSdkPhp\Contracts\ComponentInterface;
use ViaAPI\ViaSdkPhp\Routes;
use ViaAPI\ViaSdkPhp\Services\Trivia\Filters\TagFilter;
use ViaAPI\ViaSdkPhp\Services\Trivia\Handlers\TagHandler;
use ViaAPI\ViaSdkPhp\Services\Trivia\Handlers\TagMergeHandler;
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
        return $this->makeRequest(Routes::TAG_LIST, Routes::METHOD_GET, $filter);
    }

    /**
     * Insert tag entry.
     * (!) Requires grant access.
     *
     * @param TagHandler $handler
     *
     * @return ViaResponse
     */
    public function insert(TagHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::TAG_CREATE, Routes::METHOD_POST, $handler);
    }

    /**
     * Update tag  entry.
     * (!) Requires grant access.
     *
     * @param $id
     * @param TagHandler $handler
     *
     * @return ViaResponse
     */
    public function update($id, TagHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::TAG_UPDATE, ['{id}' => $id]), Routes::METHOD_PUT, $handler);
    }

    /**
     * Retrieve tag  entry.
     * (!) Requires grant access.
     *
     * @param $id
     *
     * @return ViaResponse
     */
    public function retrieve($id): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::TAG_RETRIEVE, ['{id}' => $id]), Routes::METHOD_GET);
    }

    /**
     * Delete tag  entry.
     * (!) Requires grant access.
     *
     * @param $id
     *
     * @return ViaResponse
     */
    public function delete($id): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::TAG_DELETE, ['{id}' => $id]), Routes::METHOD_DELETE);
    }

    /**
     * Merge questions of a tag into others.
     * (!) Requires grant access.
     *
     * @param TagMergeHandler $handler
     *
     * @return ViaResponse
     */
    public function merge(TagMergeHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::MERGE_TAGS, Routes::METHOD_PATCH, $handler);
    }

}