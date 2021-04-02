<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia;


use ViaAPI\ViaSdkPhp\Services\Trivia\Components\Tags;
use ViaAPI\ViaSdkPhp\Services\Trivia\Components\Questions;
use ViaAPI\ViaSdkPhp\ViaClient;

/**
 * Class TriviaClient
 *
 * @package ViaAPI\ViaSdkPhp\Trivia
 *
 * @property-read Questions $questions
 * @property-read Tags $tags
 */
class TriviaClient extends ViaClient
{

    private $components = [
        'questions' => Questions::class,
        'tags' => Tags::class
    ];

    public function __get($name)
    {
        if (array_key_exists($name, $this->components)) {
            return new $this->components[$name]($this->getKey());
        }

        return null;
    }

    function getClientUrl(): string
    {
        return 'https://trivia.api.dev.viaapi.com';
    }
}