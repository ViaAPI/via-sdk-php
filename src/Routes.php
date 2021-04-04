<?php


namespace ViaAPI\ViaSdkPhp;


class Routes
{
    // Method types
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';

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

    // Update Endpoints
    public const QUESTION_UPDATE = '/v1/question/{locale}/mc/sa/{id}';
    public const TAG_UPDATE = '/v1/tag/{locale}/{id}';
    public const DICTIONARY_UPDATE = '/v1/dictionary/{locale}/{id}';
    public const WORD_UPDATE = '/v1/word/{locale}/{id}';

    // Retrieve Endpoints
    public const QUESTION_RETRIEVE = '/v1/question/{locale}/mc/sa/{id}';
    public const TAG_RETRIEVE = '/v1/tag/{locale}/{id}';
    public const DICTIONARY_RETRIEVE = '/v1/dictionary/{locale}/{id}';
    public const WORD_RETRIEVE = '/v1/word/{locale}/{id}';

    // Delete Endpoints
    public const QUESTION_DELETE = '/v1/question/{locale}/mc/sa/{id}';
    public const TAG_DELETE = '/v1/tag/{locale}/{id}';
    public const DICTIONARY_DELETE = '/v1/dictionary/{locale}/{id}';
    public const WORD_DELETE = '/v1/word/{locale}/{id}';

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