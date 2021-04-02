<?php

namespace ViaAPI\ViaSdkPhp;

use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use GuzzleHttp\Client;

/**
 * Class ViaClient
 *
 * @package ViaAPI\ViaSdkPhp
 */
abstract class ViaClient
{
    /** @var string[] */
    private $availableLocales = ['tr-tr', 'en-us'];

    /** @var string */
    private $key;

    /** @var Client */
    protected $client;

    /** @var string */
    protected $locale;

    /**
     * ViaClient constructor.
     *
     * @param string      $key
     * @param string|null $locale
     */
    public function __construct(string $key, ?string $locale = null)
    {
        $this->key = $key;
        $this->locale = $locale ?? 'tr-tr';
        $this->client = new Client([
            'base_uri' => $this->getClientUrl(),
            'headers' => [
                'X-Api-Key' => $key
            ]
        ]);
    }

    /**
     * @param string               $uri
     * @param string               $method
     * @param RequestInterface|null $requestOptions
     *
     * @return ViaResponse
     */
    protected function makeRequest(string $uri, string $method = 'GET', RequestInterface $requestOptions): ViaResponse
    {
        try {
            $uri = $this->localeReplacements($uri);
            $response = $this->getClient()->request($method, $uri, $requestOptions->toOptions());
        } catch (\Exception $e) {
            return ViaResponse::createExceptionResponse($e);
        }

        return ViaResponse::createResponse($response);
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     *
     * @return ViaClient
     */
    public function setLocale(string $locale): ViaClient
    {
        if (!in_array($locale, $this->availableLocales)) {
            throw new \InvalidArgumentException(sprintf(
                'Locale isnt supported. Available locales are: %s',
                implode(', ', $this->availableLocales)
            ));
        }

        $this->locale = $locale;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    private function localeReplacements(string $uri): string
    {
        return str_replace('{locale}', $this->locale, $uri);
    }

    abstract function getClientUrl(): string;

}