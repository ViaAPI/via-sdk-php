<?php

namespace ViaAPI\ViaSdkPhp\Services\Dictionary\Components;

use ViaAPI\ViaSdkPhp\Contracts\ComponentInterface;
use ViaAPI\ViaSdkPhp\Routes;
use ViaAPI\ViaSdkPhp\Services\Dictionary\DictionaryClient;
use ViaAPI\ViaSdkPhp\Services\Dictionary\Filters\WordFilter;
use ViaAPI\ViaSdkPhp\Services\Dictionary\Handlers\WordHandler;
use ViaAPI\ViaSdkPhp\Traits\HasFilter;
use ViaAPI\ViaSdkPhp\ViaResponse;

class Words extends DictionaryClient implements ComponentInterface
{
    use HasFilter;

    /**
     * A list of dictionary words.
     *
     * @param WordFilter|null $filter
     *
     * @return ViaResponse
     */
    public function list(?WordFilter $filter = null): ViaResponse
    {
        $filter = $filter ?? new WordFilter();
        return $this->makeRequest(Routes::WORD_LIST, 'GET', $filter);
    }

    /**
     * Insert word  entry.
     * (!) Requires grant access.
     *
     * @param WordHandler $handler
     *
     * @return ViaResponse
     */
    public function insert(WordHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::WORD_CREATE, 'POST', $handler);
    }

}