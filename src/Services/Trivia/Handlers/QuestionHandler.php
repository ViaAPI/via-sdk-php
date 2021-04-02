<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Handlers;


use ViaAPI\ViaSdkPhp\Contracts\CollectionInterface;
use ViaAPI\ViaSdkPhp\Contracts\RequestHandlerInterface;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Banner;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Choice;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Label;

class QuestionHandler implements RequestHandlerInterface, RequestInterface
{
    /** @var Banner|null */
    private $banner;

    /** @var int */
    private $difficultyLevel;

    /** @var string */
    private $status = 'w';

    /** @var Label */
    private $label;

    /** @var Choice[] */
    private $choices = [];

    /** @var string[] */
    private $tags = [];

    /**
     * @return Banner|null
     */
    public function getBanner(): ?Banner
    {
        return $this->banner;
    }

    /**
     * @param Banner|null $banner
     *
     * @return QuestionHandler
     */
    public function setBanner(?Banner $banner): QuestionHandler
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * @return int
     */
    public function getDifficultyLevel(): int
    {
        return $this->difficultyLevel;
    }

    /**
     * @param int $difficultyLevel
     *
     * @return QuestionHandler
     */
    public function setDifficultyLevel(int $difficultyLevel): QuestionHandler
    {
        $this->difficultyLevel = $difficultyLevel;
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
     * @return QuestionHandler
     */
    public function setStatus(string $status): QuestionHandler
    {
        if (!in_array($status, ['a', 'i', 'w']))
            throw new InvalidArgumentException('Invalid status information. Please read the documentation');

        $this->status = $status;
        return $this;
    }

    /**
     * @return Label
     */
    public function getLabel(): Label
    {
        return $this->label;
    }

    /**
     * @param Label $label
     *
     * @return QuestionHandler
     */
    public function setLabel(Label $label): QuestionHandler
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return Choice[]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    /**
     * @param Choice[] $choices
     *
     * @return QuestionHandler
     */
    public function setChoices(array $choices): QuestionHandler
    {
        $this->choices = $choices;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string[] $tags
     *
     * @return QuestionHandler
     */
    public function setTags(array $tags): QuestionHandler
    {
        $this->tags = $tags;
        return $this;
    }

    public function toOptions(): array
    {
        return [
            'json' => [
                'banner' => $this->getBanner() instanceof CollectionInterface ? $this->getBanner()->toArray() : null,
                'difficultyLevel' => $this->getDifficultyLevel(),
                'status' => $this->getStatus(),
                'label' => $this->getLabel()->toArray(),
                'choices' => array_map(function (Choice $choice) {
                    return $choice->toArray();
                }, $this->getChoices()),
                'tags' => $this->getTags()
            ]
        ];
    }
}