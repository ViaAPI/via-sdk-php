<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Handlers;


use ViaAPI\ViaSdkPhp\Contracts\RequestHandlerInterface;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class TagHandler implements RequestHandlerInterface, RequestInterface
{
    /** @var string|null */
    private $icon;

    /** @var string */
    private $title;

    /** @var string */
    private $status = 'w';

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string|null $icon
     *
     * @return TagHandler
     */
    public function setIcon(?string $icon): TagHandler
    {
        $this->icon = $icon;
        return $this;
    }

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
     * @return TagHandler
     */
    public function setTitle(string $title): TagHandler
    {
        $this->title = $title;
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
     * @return TagHandler
     */
    public function setStatus(string $status): TagHandler
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
                'icon' => $this->getIcon(),
                'title' => $this->getTitle()
            ]
        ];
    }
}