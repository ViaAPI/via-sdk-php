<?php

namespace ViaAPI\ViaSdkPhp\Services\Trivia\Components;

use ViaAPI\ViaSdkPhp\Contracts\ComponentInterface;
use ViaAPI\ViaSdkPhp\Routes;
use ViaAPI\ViaSdkPhp\Services\Trivia\Filters\QuestionFilter;
use ViaAPI\ViaSdkPhp\Services\Trivia\Handlers\FeedChoicesHandler;
use ViaAPI\ViaSdkPhp\Services\Trivia\Handlers\QuestionHandler;
use ViaAPI\ViaSdkPhp\Services\Trivia\TriviaClient;
use ViaAPI\ViaSdkPhp\Traits\HasFilter;
use ViaAPI\ViaSdkPhp\ViaResponse;

class Questions extends TriviaClient implements ComponentInterface
{
    use HasFilter;

    /**
     * A list of trivia multi choice single records.
     *
     * @param QuestionFilter|null $filter
     *
     * @return ViaResponse
     */
    public function list(?QuestionFilter $filter = null): ViaResponse
    {
        $filter = $filter ?? new QuestionFilter();
        return $this->makeRequest(Routes::QUESTION_LIST, Routes::METHOD_GET, $filter);
    }

    /**
     * Insert multi-choice single question  entry.
     * (!) Requires grant access.
     *
     * @param QuestionHandler $handler
     *
     * @return ViaResponse
     */
    public function insert(QuestionHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::QUESTION_CREATE, Routes::METHOD_POST, $handler);
    }

    /**
     * Update multi-choice single question  entry.
     * (!) Requires grant access.
     *
     * @param $id
     * @param QuestionHandler $handler
     *
     * @return ViaResponse
     */
    public function update($id, QuestionHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::QUESTION_UPDATE, ['{id}' => $id]), Routes::METHOD_PUT, $handler);
    }

    /**
     * Retrieve multi-choice single question  entry.
     * (!) Requires grant access.
     *
     * @param $id
     *
     * @return ViaResponse
     */
    public function retrieve($id): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::QUESTION_RETRIEVE, ['{id}' => $id]), Routes::METHOD_GET);
    }

    /**
     * Delete multi-choice single question  entry.
     * (!) Requires grant access.
     *
     * @param $id
     *
     * @return ViaResponse
     */
    public function delete($id): ViaResponse
    {
        return $this->makeRequest(Routes::fetchRoute(Routes::QUESTION_DELETE, ['{id}' => $id]), Routes::METHOD_DELETE);
    }

    /**
     * Feed choices stats.
     * (!) Requires grant access.
     *
     * @param FeedChoicesHandler $handler
     *
     * @return ViaResponse
     */
    public function feed(FeedChoicesHandler $handler): ViaResponse
    {
        return $this->makeRequest(Routes::FEED_STATS_QUESTION_CHOICES, Routes::METHOD_POST, $handler);
    }

}