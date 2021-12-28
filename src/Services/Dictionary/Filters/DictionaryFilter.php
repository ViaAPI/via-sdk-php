<?php

namespace ViaAPI\ViaSdkPhp\Services\Dictionary\Filters;

use ViaAPI\ViaSdkPhp\Comparisons;
use ViaAPI\ViaSdkPhp\Constants\StatusConstants;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\ExceededLimitException;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class DictionaryFilter implements RequestInterface
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
    private $wordCount = [];

    /** @var array  */
    private $q = [];

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
     * @return DictionaryFilter
     */
    public function setLimit(int $limit): DictionaryFilter
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
     * @return DictionaryFilter
     */
    public function setOffset(int $offset): DictionaryFilter
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
     * @return DictionaryFilter
     */
    public function setOrder(array $order): DictionaryFilter
    {
        foreach ($order as $field => $direction) {
            if (!in_array($field, ['createdAt', 'updatedAt', 'wordCount', 'title'])) {
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
     * @return DictionaryFilter
     */
    public function setCreatedAt(array $createdAt): DictionaryFilter
    {
        foreach ($createdAt as $comparison => $date) {
            if (!is_string($date)) {
                throw new InvalidArgumentException('Invalid argument for date. Please read the documentation.');
            }

            if (!Comparisons::checkAvailabilityOfComparison($comparison)) {
                throw new InvalidArgumentException("Unsupported comparison types. Please read documentation.");
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
     * @return DictionaryFilter
     */
    public function setUpdatedAt(array $updatedAt): DictionaryFilter
    {
        foreach ($updatedAt as $comparison => $date) {
            if (!$date) {
                throw new InvalidArgumentException('Invalid argument for date. Please read the documentation.');
            }

            if (!Comparisons::checkAvailabilityOfComparison($comparison)) {
                throw new InvalidArgumentException("Unsupported comparison types. Please read documentation.");
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
     * @return DictionaryFilter
     */
    public function setStatus(array $statuses): DictionaryFilter
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
    public function getWordCount(): array
    {
        return $this->wordCount;
    }

    /**
     * @param array $wordCount
     *
     * @return DictionaryFilter
     */
    public function setWordCount(array $wordCount): DictionaryFilter
    {
        foreach ($wordCount as $comparison => $value) {
            if (!is_numeric($value))
                throw new InvalidArgumentException('Word count values must be numeric. Please read documentation.');

            if (!Comparisons::checkAvailabilityOfComparison($comparison))
                throw new InvalidArgumentException("Unsupported comparison types. Please read documentation.");

            $this->wordCount[$comparison] = $value;
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
     * @return DictionaryFilter
     */
    public function setQuery(array $q): DictionaryFilter
    {
        foreach ($q as $field => $keyword) {
            if (!in_array($field, ['title', 'desc']))
                throw new InvalidArgumentException('Invalid query field. Please read the documentation.');

            $this->q[$field][] = $keyword;
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

        if (!empty($this->getWordCount())) {
            $query['wordCount'] = $this->getWordCount();
        }

        if (!empty($this->getQuery())) {
            $query['q'] = $this->getQuery();
        }

        return [
            'query' => $query
        ];
    }
}