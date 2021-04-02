<?php


namespace ViaAPI\ViaSdkPhp\Services\Dictionary\Handlers;


use ViaAPI\ViaSdkPhp\Contracts\RequestHandlerInterface;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class WordHandler implements RequestHandlerInterface, RequestInterface
{
    /** @var string */
    private $word;

    /** @var string[]|null */
    private $definitions = [];

    /** @var string[] */
    private $dictionaries = [];

    /** @var string */
    private $status = 'w';

    /**
     * @return string
     */
    public function getWord(): string
    {
        return $this->word;
    }

    /**
     * @param string $word
     *
     * @return WordHandler
     */
    public function setWord(string $word): WordHandler
    {
        $this->word = $word;
        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getDefinitions(): ?array
    {
        return $this->definitions;
    }

    /**
     * @param string[]|null $definitions
     *
     * @return WordHandler
     */
    public function setDefinitions(?array $definitions): WordHandler
    {
        $this->definitions = $definitions;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getDictionaries(): array
    {
        return $this->dictionaries;
    }

    /**
     * @param string[] $dictionaries
     *
     * @return WordHandler
     */
    public function setDictionaries(array $dictionaries): WordHandler
    {
        $this->dictionaries = $dictionaries;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return WordHandler
     */
    public function setStatus(string $status): WordHandler
    {
        if (!in_array($status, ['a', 'i', 'w']))
            throw new InvalidArgumentException('Invalid status information. Please read the documentation');

        $this->status = $status;
        return $this;
    }

    public function toOptions(): array
    {
        return [
            'json' => [
                'word' => $this->getWord(),
                'definitions' => $this->getDefinitions(),
                'dictionaries' => $this->getDictionaries(),
                'status' => $this->getStatus()
            ]
        ];
    }
}