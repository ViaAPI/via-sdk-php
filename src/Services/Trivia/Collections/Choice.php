<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Collections;


use ViaAPI\ViaSdkPhp\Contracts\CollectionInterface;

class Choice implements CollectionInterface
{
    /** @var bool */
    private $isCorrect;

    /** @var Label */
    private $label;

    /**
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    /**
     * @param bool $isCorrect
     *
     * @return Choice
     */
    public function setIsCorrect(bool $isCorrect): Choice
    {
        $this->isCorrect = $isCorrect;
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
     * @return Choice
     */
    public function setLabel(Label $label): Choice
    {
        $this->label = $label;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'isCorrect' => $this->isCorrect(),
            'label' => $this->getLabel()->toArray()
        ];
    }
}