<?php


namespace ViaAPI\ViaSdkPhp\Services\Dictionary\Handlers;


use ViaAPI\ViaSdkPhp\Contracts\RequestHandlerInterface;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class DictionaryHandler implements RequestHandlerInterface, RequestInterface
{
    /** @var string */
    private $title;

    /** @var string|null */
    private $description = null;

    /** @var int|null */
    private $wordCount = null;

    /** @var int|null */
    private $type = null;

    /** @var string */
    private $status = 'w';

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return DictionaryHandler
     */
    public function setTitle(string $title): DictionaryHandler
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return DictionaryHandler
     */
    public function setDescription(?string $description): DictionaryHandler
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWordCount(): ?int
    {
        return $this->wordCount;
    }

    /**
     * @param int|null $wordCount
     *
     * @return DictionaryHandler
     */
    public function setWordCount(?int $wordCount): DictionaryHandler
    {
        $this->wordCount = $wordCount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     *
     * @return DictionaryHandler
     */
    public function setType(?int $type): DictionaryHandler
    {
        $this->type = $type;
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
     * @return DictionaryHandler
     */
    public function setStatus(string $status): DictionaryHandler
    {
        if (!in_array($status, ['a', 'i', 'w']))
            throw new InvalidArgumentException('Invalid status information. Please read the documentation');

        $this->status = $status;
        return $this;
    }

    public function toOptions(): array
    {
        $response =  [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus()
        ];

        if (null !== $this->getWordCount()) {
            $response['wordCount'] = $this->getWordCount();
        }

        if (null !== $this->getType()) {
            $response['type'] = $this->getType();
        }

        return [
            'json' => $response
        ];
    }
}