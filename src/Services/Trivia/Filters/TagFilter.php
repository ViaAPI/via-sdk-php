<?php

namespace ViaAPI\ViaSdkPhp\Services\Trivia\Filters;

use ViaAPI\ViaSdkPhp\Comparisons;
use ViaAPI\ViaSdkPhp\Constants\StatusConstants;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\ExceededLimitException;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class TagFilter implements RequestInterface
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
    private $itemCount = [];

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
     * @return TagFilter
     */
    public function setLimit(int $limit): TagFilter
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
     * @return TagFilter
     */
    public function setOffset(int $offset): TagFilter
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
     * @return TagFilter
     */
    public function setOrder(array $order): TagFilter
    {
        foreach ($order as $field => $direction) {
            if (!in_array($field, ['createdAt', 'updatedAt', 'title', 'itemCount'])) {
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
     * @return TagFilter
     */
    public function setCreatedAt(array $createdAt): TagFilter
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
     * @return TagFilter
     */
    public function setUpdatedAt(array $updatedAt): TagFilter
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
     * @return TagFilter
     */
    public function setStatus(array $statuses): TagFilter
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
    public function getItemCount(): array
    {
        return $this->itemCount;
    }

    /**
     * @param array $itemCount
     *
     * @return TagFilter
     */
    public function setItemCount(array $itemCount): TagFilter
    {
        foreach ($itemCount as $comparison => $value) {
            if (!is_numeric($value))
                throw new InvalidArgumentException('Item count values must be numeric. Please read documentation.');

            $this->itemCount[$comparison] = $value;
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
     * @return TagFilter
     */
    public function setQuery(array $q): TagFilter
    {
        foreach ($q as $keyword) {
            $this->q['title'][] = $keyword;
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

        if (!empty($this->getItemCount())) {
            $query['itemCount'] = $this->getItemCount();
        }

        if (!empty($this->getQuery())) {
            $query['q'] = $this->getQuery();
        }

        return [
            'query' => $query
        ];
    }
}