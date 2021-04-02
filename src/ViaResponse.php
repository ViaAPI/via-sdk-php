<?php

namespace ViaAPI\ViaSdkPhp;

use ViaAPI\ViaSdkPhp\Utilities\ViaResult;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;

class ViaResponse
{
    /** @var bool */
    private $hasSuccess;

    /** @var string */
    private $code;

    /** @var string */
    private $message;

    /** @var ViaResult */
    private $result;

    /** @var \Exception |null */
    private $exception;

    public function __construct(
        string $code,
        $result = null,
        bool $hasSuccess = true,
        ?string $message = null,
        ?\Exception $exception = null
    ) {
        $this->result = $result;
        $this->hasSuccess = $hasSuccess;
        $this->code = $code;
        $this->message = $message ?? '';
        $this->exception = $exception;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return ViaResponse
     */
    public function setCode(string $code): ViaResponse
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasSuccess(): bool
    {
        return $this->hasSuccess;
    }

    /**
     * @param bool $hasSuccess
     *
     * @return ViaResponse
     */
    public function setHasSuccess(bool $hasSuccess): ViaResponse
    {
        $this->hasSuccess = $hasSuccess;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return ViaResponse
     */
    public function setMessage(string $message): ViaResponse
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return ViaResult
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param ViaResult $result
     *
     * @return ViaResponse
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return \Exception|null
     */
    public function getException(): ?\Exception
    {
        return $this->exception;
    }

    /**
     * @param \Exception |null $exception
     *
     * @return ViaResponse
     */
    public function setException(?\Exception $exception): ViaResponse
    {
        $this->exception = $exception;
        return $this;
    }

    public static function createExceptionResponse(\Exception $exception): ViaResponse
    {
        $code = '500.0000';
        switch (get_class($exception)) {
            case ClientException::class:
                $response = $exception->getResponse();
                $responseMessage = json_decode((string) $response->getBody()->getContents(), true);
                $message = $responseMessage['message'];
                $code = $responseMessage['code'];
                break;

            case ServerException::class:
                $message = 'Server error occured.';
                break;
            default:
                $message = $exception->getMessage();
                break;
        }

        return (new static($code))->setException($exception)
            ->setHasSuccess(false)
            ->setMessage($message)
            ->setResult(null);
    }

    public static function createResponse(ResponseInterface $response): ViaResponse
    {
        $responseContent = json_decode($response->getBody()->getContents(), true);
        return (new static($responseContent['code']))
            ->setResult(ViaResult::createFromArray($responseContent['result']))
            ->setMessage($responseContent['message'])
            ->setHasSuccess(true);
    }

}