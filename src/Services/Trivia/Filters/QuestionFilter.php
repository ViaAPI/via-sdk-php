<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Filters;


use ViaAPI\ViaSdkPhp\Comparisons;
use ViaAPI\ViaSdkPhp\Constants\StatusConstants;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\ExceededLimitException;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class QuestionFilter implements RequestInterface
{
    /** @var int */
    private $limit = 50;

    /** @var int */
    private $offset = 0;

    /** @var array  */
    private $order = [];

    /** @var array  */
    private $createdAt = [];

    /** @var array  */
    private $updatedAt = [];

    /** @var array  */
    private $status = [];

    /** @var array  */
    private $difficultyLevel = [];

    /** @var array  */
    private $estimatedReadTime = [];

    /** @var array  */
    private $q = [];

    /** @var array  */
    private $tags = [];

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     *
     * @return QuestionFilter
     */
    public function setLimit(int $limit): QuestionFilter
    {
        if ($limit < 1 || $limit > 200)
            throw new ExceededLimitException('Invalid limit value. Value must be between 1 and 200.');

        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     *
     * @return QuestionFilter
     */
    public function setOffset(int $offset): QuestionFilter
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * @param array $order
     *
     * @return QuestionFilter
     */
    public function setOrder(array $order): QuestionFilter
    {
        foreach ($order as $field => $direction) {
            if (!in_array($field, ['createdAt', 'updatedAt', 'difficultyLevel', 'label.text'])) {
                throw new InvalidArgumentException('Invalid field for order criteria. Please read the documentation.');
            }

            $this->order[] = Comparisons::identifyOrderDirection($direction) . $field;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getCreatedAt(): array
    {
        return $this->createdAt;
    }

    /**
     * @param array $createdAt
     *
     * @return QuestionFilter
     */
    public function setCreatedAt(array $createdAt): QuestionFilter
    {
        foreach ($createdAt as $comparison => $date) {
            if (!is_string($date)) {
                throw new InvalidArgumentException('Invalid argument for date. Please read the documentation.');
            }

            $this->createdAt[$comparison] = $date;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getUpdatedAt(): array
    {
        return $this->updatedAt;
    }

    /**
     * @param array $updatedAt
     *
     * @return QuestionFilter
     */
    public function setUpdatedAt(array $updatedAt): QuestionFilter
    {
        foreach ($updatedAt as $comparison => $date) {
            if (!is_string($date)) {
                throw new InvalidArgumentException('Invalid argument for date. Please read the documentation.');
            }

            $this->updatedAt[$comparison] = $date;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @param array $statuses
     *
     * @return QuestionFilter
     */
    public function setStatus(array $statuses): QuestionFilter
    {
        foreach ($statuses as $status) {
            if (!StatusConstants::isAvailableStatus($status)) {
                throw new InvalidArgumentException('Invalid argument for status. Please read documentation.');
            }
        }

        $this->status = $statuses;
        return $this;
    }

    /**
     * @return array
     */
    public function getDifficultyLevel(): array
    {
        return $this->difficultyLevel;
    }

    /**
     * @param array $difficultyLevel
     *
     * @return QuestionFilter
     */
    public function setDifficultyLevel(array $difficultyLevel): QuestionFilter
    {
        foreach ($difficultyLevel as $comparison => $value) {
            if (!is_numeric($value))
                throw new InvalidArgumentException('Difficulty level values must be numeric. Please read documentation.');

            if ($value > 10 || $value < 1)
                throw new InvalidArgumentException('Difficulty level values must between 1 and 10. Please read documentation.');

            $this->difficultyLevel[$comparison] = $value;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getEstimatedReadTime(): array
    {
        return $this->estimatedReadTime;
    }

    /**
     * @param array $estimatedReadTime
     *
     * @return QuestionFilter
     */
    public function setEstimatedReadTime(array $estimatedReadTime): QuestionFilter
    {
        foreach ($estimatedReadTime as $comparison => $value) {
            if (!is_numeric($value))
                throw new InvalidArgumentException('Estimated read time values must be numeric. Please read documentation.');

            $this->estimatedReadTime[$comparison] = $value;
        }

        return $this;
    }


    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->q;
    }

    /**
     * @param array $q
     *
     * @return QuestionFilter
     */
    public function setQuery(array $q): QuestionFilter
    {
        foreach ($q as $field => $keyword) {
            $this->q[$field][] = $keyword;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     *
     * @return QuestionFilter
     */
    public function setTags(array $tags): QuestionFilter
    {
        foreach ($tags as $comparison => $value) {
            if (!Comparisons::checkAvailabilityOfComparison($comparison))
                throw new InvalidArgumentException("Unsupported comparison types. Please read documentation.");

            $this->tags[$comparison] = $value;
        }

        return $this;
    }

    public function toOptions(): array
    {
        $query = [
            'limit' => $this->getLimit(),
            'offset' => $this->getOffset()
        ];

        if (!empty($this->getOrder())) {
            $query['order'] = $this->getOrder();
        }

        if (!empty($this->getCreatedAt())) {
            $query['createdAt'] = $this->getCreatedAt();
        }

        if (!empty($this->getUpdatedAt())) {
            $query['updatedAt'] = $this->getUpdatedAt();
        }

        if (!empty($this->getStatus())) {
            $query['status'] = $this->getStatus();
        }

        if (!empty($this->getDifficultyLevel())) {
            $query['difficultyLevel'] = $this->getDifficultyLevel();
        }

        if (!empty($this->getEstimatedReadTime())) {
            $query['estimatedReadTime'] = $this->getEstimatedReadTime();
        }

        if (!empty($this->getQuery())) {
            $query['q'] = $this->getQuery();
        }

        if (!empty($this->getTags())) {
            $query['tags'] = $this->getTags();
        }

        return [
            'query' => $query
        ];
    }
}