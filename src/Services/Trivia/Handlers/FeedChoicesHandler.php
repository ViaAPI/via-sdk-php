<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Handlers;


use ViaAPI\ViaSdkPhp\Contracts\CollectionInterface;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;
use ViaAPI\ViaSdkPhp\Services\AbstractHandler;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Banner;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Choice;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\ChoiceStat;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Label;

class FeedChoicesHandler extends AbstractHandler
{
    /** @var \DateTime */
    private $startedAt;

    /** @var \DateTime */
    private $endedAt;

    /** @var ChoiceStat[] */
    private $choices = [];

    public function __construct(\DateTime $startedAt, \DateTime $endedAt, array $choices)
    {
        parent::__construct(array(
            'startedAt' => $startedAt,
            'endedAt' => $endedAt,
            'choices' => $choices
        ));
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param  \DateTime  $startedAt
     *
     * @return FeedChoicesHandler
     */
    public function setStartedAt(\DateTime $startedAt): FeedChoicesHandler
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndedAt(): \DateTime
    {
        return $this->endedAt;
    }

    /**
     * @param  \DateTime  $endedAt
     *
     * @return FeedChoicesHandler
     */
    public function setEndedAt(\DateTime $endedAt): FeedChoicesHandler
    {
        $this->endedAt = $endedAt;
        return $this;
    }

    /**
     * @return ChoiceStat[]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    /**
     * @param  ChoiceStat[]  $choices
     *
     * @return FeedChoicesHandler
     */
    public function setChoices(array $choices): FeedChoicesHandler
    {
        foreach ($choices as $choice) {
            if (!$choice instanceof ChoiceStat)
                throw new InvalidArgumentException('ChoiceStat must be instance of ' . ChoiceStat::class);
        }

        $this->choices = $choices;

        return $this;
    }

    public function toOptions(): array
    {
        return [
            'json' => [
                'startedAt' => $this->getStartedAt()->format('Y-m-d H:i:s'),
                'endedAt' => $this->getEndedAt()->format('Y-m-d H:i:s'),
                'choices' => array_map(function (ChoiceStat $choiceItem) {
                    return $choiceItem->toArray();
                }, $this->getChoices())
            ]
        ];
    }
}