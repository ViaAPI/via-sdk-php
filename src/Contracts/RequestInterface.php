<?php


namespace ViaAPI\ViaSdkPhp\Contracts;


use ViaAPI\ViaSdkPhp\ViaResponse;

interface RequestInterface {
    public function toOptions(): array;
}