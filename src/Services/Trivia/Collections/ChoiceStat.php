<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Collections;


use ViaAPI\ViaSdkPhp\Contracts\CollectionInterface;

class ChoiceStat implements CollectionInterface
{
    /** @var string */
    private $question;

    /** @var array */
    private $stats;

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param  string  $question
     *
     * @return ChoiceStat
     */
    public function setQuestion(string $question): ChoiceStat
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }

    /**
     * @param  array  $stats
     *
     * @return ChoiceStat
     */
    public function setStats(array $stats): ChoiceStat
    {
        $this->stats = $stats;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'question' => $this->getQuestion(),
            'stats' => array_map(function (ChoiceStatItem $item) {
                return $item->toArray();
            }, $this->getStats())
        ];
    }
}