<?php


namespace ViaAPI\ViaSdkPhp\Contracts;


interface RequestInterface
{
    public function toOptions(): array;
}