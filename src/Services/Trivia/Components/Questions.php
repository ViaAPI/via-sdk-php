<?php

namespace ViaAPI\ViaSdkPhp\Services\Trivia\Components;

use ViaAPI\ViaSdkPhp\Contracts\ComponentInterface;
use ViaAPI\ViaSdkPhp\Routes;
use ViaAPI\ViaSdkPhp\Services\Trivia\Filters\QuestionFilter;
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
        return $this->makeRequest(Routes::QUESTION_LIST, 'GET', $filter);
    }
}