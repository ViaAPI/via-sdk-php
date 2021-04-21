<?php

namespace ViaAPI\ViaSdkPhp\Services\Dictionary;

use ViaAPI\ViaSdkPhp\Services\Dictionary\Components\Dictionaries;
use ViaAPI\ViaSdkPhp\Services\Dictionary\Components\Words;
use ViaAPI\ViaSdkPhp\ViaClient;


/**
 * Class DictionaryClient
 *
 * @package ViaAPI\ViaSdkPhp\Dictionary
 *
 * @property-read Dictionaries $dictionaries
 * @property-read Words $words
 */
class DictionaryClient extends ViaClient
{

    private $components = [
        'dictionaries' => Dictionaries::class,
        'words' => Words::class
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
        return 'https://dictionary.api.dev.viaapi.com';
    }
}