<?php


namespace ViaAPI\ViaSdkPhp;


class Routes
{
    // List Endpoints
    public const QUESTION_LIST = '/v1/questions/{locale}/mc/sa';
    public const TAG_LIST = '/v1/tags/{locale}';
    public const DICTIONARY_LIST = '/v1/dictionaries/{locale}';
    public const WORD_LIST = '/v1/words/{locale}';

    // Insert Endpoints
    public const QUESTION_CREATE = '/v1/question/{locale}/mc/sa';
    public const TAG_CREATE = '/v1/tag/{locale}';
    public const DICTIONARY_CREATE = '/v1/dictionary/{locale}';
    public const WORD_CREATE = '/v1/word/{locale}';

    /**
     * Provides to replace values instead of dynamic values
     *
     * @param string $route
     * @param array  $params
     *
     * @return string
     */
    public static function fetchRoute(string $route, array $params): string
    {
        foreach ($params as $k => $v) {
            $route = str_replace($k, $v, $route);
        }

        return $route;
    }
}