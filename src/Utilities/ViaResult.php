<?php


namespace ViaAPI\ViaSdkPhp\Utilities;

class ViaResult
{
    /** @var ViaPagination|null  */
    private $pagination = null;

    /** @var mixed */
    private $set;

    /**
     * ViaResult constructor.
     *
     * @param mixed              $result
     * @param ViaPagination|null $pagination
     */
    public function __construct($result = null, ?ViaPagination $pagination = null)
    {
        $this->set = $result;
        $this->pagination = $pagination;
    }

    /**
     * @return ViaPagination|null
     */
    public function getPagination(): ?ViaPagination
    {
        return $this->pagination;
    }

    /**
     * @param ViaPagination|null $pagination
     *
     * @return ViaResult
     */
    public function setPagination(?ViaPagination $pagination): ViaResult
    {
        $this->pagination = $pagination;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * @param mixed $set
     *
     * @return ViaResult
     */
    public function setSet($set)
    {
        $this->set = $set;
        return $this;
    }

    public static function createFromArray(array $result): ViaResult
    {
        return (new static())->setSet($result['set'])
            ->setPagination(null != $result['pagination'] ? ViaPagination::createFromArray($result['pagination']): null);
    }

    public function outputToArray(): array
    {
        return array(
            'pagination' => null !== $this->getPagination() ? $this->getPagination()->outputToArray() : null,
            'set' => $this->getSet()
        );
    }
}