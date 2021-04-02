<?php

namespace ViaAPI\ViaSdkPhp\Services;

use ViaAPI\ViaSdkPhp\Contracts\RequestHandlerInterface;
use ViaAPI\ViaSdkPhp\Contracts\RequestInterface;

abstract class AbstractHandler implements RequestInterface
{
    public function __construct(array $props = null) {
        if (is_array($props) && !empty($props))
            $this->createFromProps($props);
    }

    private function createFromProps(array $props): void
    {
        foreach ($props as $prop => $value) {
            $setter = 'set' . ucfirst($prop);
            if (method_exists($this, $setter)) {
                $this->{$setter}($value);
            }
        }
    }

}