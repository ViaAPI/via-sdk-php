<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Handlers;


use ViaAPI\ViaSdkPhp\Contracts\CollectionInterface;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;
use ViaAPI\ViaSdkPhp\Services\AbstractHandler;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Banner;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Choice;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\ChoiceStat;
use ViaAPI\ViaSdkPhp\Services\Trivia\Collections\Label;

class TagMergeHandler extends AbstractHandler
{
    /** @var string */
    private $tag;

    /** @var array */
    private $into;

    /** @var bool */
    private $forceDelete = false;

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param  string  $tag
     *
     * @return TagMergeHandler
     */
    public function setTag(string $tag): TagMergeHandler
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return array
     */
    public function getInto(): array
    {
        return $this->into;
    }

    /**
     * @param  array  $into
     *
     * @return TagMergeHandler
     */
    public function setInto(array $into): TagMergeHandler
    {
        foreach ($into as $item) {
            if (!is_string($item))
                throw new InvalidArgumentException('Invalid item information. Please read the documentation');
        }

        $this->into = $into;
        return $this;
    }

    /**
     * @return bool
     */
    public function isForceDelete(): bool
    {
        return $this->forceDelete;
    }

    /**
     * @param  bool  $forceDelete
     *
     * @return TagMergeHandler
     */
    public function setForceDelete(bool $forceDelete): TagMergeHandler
    {
        $this->forceDelete = $forceDelete;
        return $this;
    }

    public function toOptions(): array
    {
        $query = [
            'tag' => $this->getTag(),
            'into' => implode(',', $this->getInto())
        ];

        if ($this->isForceDelete) {
            $query['forceDelete'] = 'y';
        }

        return [
            'query' => $query
        ];
    }
}