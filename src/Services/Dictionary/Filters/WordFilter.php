<?php


namespace ViaAPI\ViaSdkPhp\Services\Dictionary\Filters;


use ViaAPI\ViaSdkPhp\Comparisons;
use ViaAPI\ViaSdkPhp\Constants\StatusConstants;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;
use ViaAPI\ViaSdkPhp\Exceptions\ExceededLimitException;
use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class WordFilter implements RequestInterface
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
    private $dictionaries = [];

    /** @var array  */
    private $totalCharCount = [];

    /** @var array  */
    private $totalCharCountWithBlanks = [];

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
     * @return WordFilter
     */
    public function setLimit(int $limit): WordFilter
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
     * @return WordFilter
     */
    public function setOffset(int $offset): WordFilter
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
     * @return WordFilter
     */
    public function setOrder(array $order): WordFilter
    {
        foreach ($order as $field => $direction) {
            if (!in_array($field, ['createdAt', 'updatedAt', 'totalCharCount', 'wordCount', 'totalCharCountWithBlanks', 'word']))
                throw new InvalidArgumentException('Invalid field for order criteria. Please read the documentation.');

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
     * @return WordFilter
     */
    public function setCreatedAt(array $createdAt): WordFilter
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
     * @return WordFilter
     */
    public function setUpdatedAt(array $updatedAt): WordFilter
    {
        foreach ($updatedAt as $comparison => $date) {
            if (!is_string($date)) {
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
     * @return WordFilter
     */
    public function setStatus(array $statuses): WordFilter
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
    public function getQuery(): array
    {
        return $this->q;
    }

    /**
     * @param array $q
     *
     * @return WordFilter
     */
    public function setQuery(array $q): WordFilter
    {
        foreach ($q as $field => $keyword) {
            if (!in_array($field, ['w', 'def']))
                throw new InvalidArgumentException('Invalid query field. Please read the documentation.');

            $this->q[$field][] = $keyword;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getDictionaries(): array
    {
        return $this->dictionaries;
    }

    /**
     * @param array $dictionaries
     *
     * @return WordFilter
     */
    public function setDictionaries(array $dictionaries): WordFilter
    {
        foreach ($dictionaries as $comparison => $value) {
            if (!Comparisons::checkAvailabilityOfComparison($comparison))
                throw new InvalidArgumentException("Unsupported comparison types. Please read documentation.");

            $this->dictionaries[$comparison] = $value;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTotalCharCount(): array
    {
        return $this->totalCharCount;
    }

    /**
     * @param array $totalCharCount
     *
     * @return WordFilter
     */
    public function setTotalCharCount(array $totalCharCount): WordFilter
    {
        foreach ($totalCharCount as $comparison => $value) {
            if (!is_numeric($value))
                throw new InvalidArgumentException('Count values must be numeric. Please read documentation.');

            if (!Comparisons::checkAvailabilityOfComparison($comparison))
                throw new InvalidArgumentException("Unsupported comparison types. Please read documentation.");

            $this->totalCharCount[$comparison] = $value;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTotalCharCountWithBlanks(): array
    {
        return $this->totalCharCountWithBlanks;
    }

    /**
     * @param array $totalCharCountWithBlanks
     *
     * @return WordFilter
     */
    public function setTotalCharCountWithBlanks(array $totalCharCountWithBlanks): WordFilter
    {
        foreach ($totalCharCountWithBlanks as $comparison => $value) {
            if (!is_numeric($value))
                throw new InvalidArgumentException('Count values must be numeric. Please read documentation.');

            if (!Comparisons::checkAvailabilityOfComparison($comparison))
                throw new InvalidArgumentException("Unsupported comparison types. Please read documentation.");

            $this->totalCharCountWithBlanks[$comparison] = $value;
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

        if (!empty($this->getDictionaries())) {
            $query['dictionaries'] = $this->getDictionaries();
        }

        if (!empty($this->getTotalCharCount())) {
            $query['totalCharCount'] = $this->getTotalCharCount();
        }

        if (!empty($this->getTotalCharCountWithBlanks())) {
            $query['totalCharCountWithBlanks'] = $this->getTotalCharCountWithBlanks();
        }

        if (!empty($this->getQuery())) {
            $query['q'] = $this->getQuery();
        }

        return [
            'query' => $query
        ];
    }
}