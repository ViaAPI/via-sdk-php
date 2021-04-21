<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Collections;


use ViaAPI\ViaSdkPhp\Contracts\CollectionInterface;

class ChoiceStatItem implements CollectionInterface
{
    /** @var string */
    private $choice;

    /** @var int */
    private $count;

    /**
     * @return string
     */
    public function getChoice(): string
    {
        return $this->choice;
    }

    /**
     * @param  string  $choice
     *
     * @return ChoiceStatItem
     */
    public function setChoice(string $choice): ChoiceStatItem
    {
        $this->choice = $choice;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param  int  $count
     *
     * @return ChoiceStatItem
     */
    public function setCount(int $count): ChoiceStatItem
    {
        $this->count = $count;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'choice' => $this->getChoice(),
            'count' => $this->getCount()
        ];
    }
}