<?php

namespace ViaAPI\ViaSdkPhp\Utilities;

class ViaPagination
{
    /**
     * @var bool|null
     */
    private $circular = true;

    /**
     * @var null|string
     */
    private $prevLink = '';

    /**
     * @var null|string
     */
    private $nextLink = '';

    /**
     * @var null|string
     */
    private $firstLink = '';

    /**
     * @var null|string
     */
    private $lastLink = '';

    /**
     * @var int|null
     */
    private $recordCount = 0;

    /**
     * @var int|null
     */
    private $filteredRecordCount = 0;

    /**
     * @var int|null
     */
    private $itemsPerPage = 20;

    /**
     * @var int
     */
    private $pageCount = 1;

    /**
     * @var int|null
     */
    private $currentPage = 1;

    /**
     * @return int
     */
    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    /**
     * @param $pageCount
     * @return $this
     */
    public function setPageCount($pageCount): ViaPagination
    {
        $this->pageCount = $pageCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getRecordCount(): ?int
    {
        return $this->recordCount;
    }

    /**
     * @param $recordCount
     * @return $this
     */
    public function setRecordCount($recordCount): ViaPagination
    {
        $this->recordCount = $recordCount;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFilteredRecordCount(): ?int
    {
        return $this->filteredRecordCount;
    }

    /**
     * @param int|null $filteredRecordCount
     *
     * @return ViaPagination
     */
    public function setFilteredRecordCount(?int $filteredRecordCount): ViaPagination
    {
        $this->filteredRecordCount = $filteredRecordCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstLink(): ?string
    {
        return $this->firstLink;
    }

    /**
     * @param string|null $firstLink
     * @return $this
     */
    public function setFirstLink(string $firstLink = null): ViaPagination
    {
        $this->firstLink = $firstLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastLink(): ?string
    {
        return $this->lastLink;
    }

    /**
     * @param string|null $lastLink
     * @return $this
     */
    public function setLastLink(string $lastLink = null): ViaPagination
    {
        $this->lastLink = $lastLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrevLink(): ?string
    {
        return $this->prevLink;
    }

    /**
     * @param string|null $prevLink
     * @return $this
     */
    public function setPrevLink(string $prevLink = null): ViaPagination
    {
        $this->prevLink = $prevLink;
        return $this;
    }

    /**
     * @return string
     */
    public function getNextLink(): ?string
    {
        return $this->nextLink;
    }

    /**
     * @param string|null $nextLink
     * @return $this
     */
    public function setNextLink(string $nextLink = null): ViaPagination
    {
        $this->nextLink = $nextLink;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): ?int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     * @return $this
     */
    public function setCurrentPage(int $currentPage): ViaPagination
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getItemsPerPage(): ?int
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     * @return $this
     */
    public function setItemsPerPage(int $itemsPerPage): ViaPagination
    {
        $this->itemsPerPage = $itemsPerPage;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCircular(): ?bool
    {
        return $this->circular;
    }

    /**
     * @param bool $circular
     * @return $this
     */
    public function setCircular(bool $circular): ViaPagination
    {
        $this->circular = $circular;
        return $this;
    }

    public static function createFromArray(array $pagination): ViaPagination
    {
        return (new static())->setCircular($pagination['isCircular'])
            ->setPrevLink($pagination['prevLink'])
            ->setNextLink($pagination['nextLink'])
            ->setLastLink($pagination['lastLink'])
            ->setFirstLink($pagination['firstLink'])
            ->setRecordCount($pagination['totalItems'])
            ->setFilteredRecordCount($pagination['filteredItems'])
            ->setItemsPerPage($pagination['itemsPerPage'])
            ->setPageCount($pagination['pageCount'])
            ->setCurrentPage($pagination['currentPage']);
    }

    public function outputToArray(): array
    {
        return array(
            'isCircular' => $this->getCircular(),
            'prevLink' => $this->getPrevLink(),
            'nextLink' => $this->getNextLink(),
            'lastLink' => $this->getLastLink(),
            'firstLink' => $this->getFirstLink(),
            'totalItems' => $this->getRecordCount(),
            'filteredItems' => $this->getFilteredRecordCount(),
            'itemsPerPage' => $this->getItemsPerPage(),
            'pageCount' => $this->getPageCount(),
            'currentPage' => $this->getCurrentPage()
        );
    }
}