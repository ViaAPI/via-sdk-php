<?php

namespace ViaAPI\ViaSdkPhp;

use ViaAPI\ViaSdkPhp\Exceptions\InvalidArgumentException;

class Comparisons
{
    public const EQUAL = 'eq';
    public const NOT_EQUAL = 'nq';
    public const GREATER_THAN = 'gt';
    public const GREATER_OR_EQUAL_THEN = 'gte';
    public const LESS_THEN = 'lt';
    public const LESS_OR_EQUAL_THEN = 'lte';
    public const IN = 'in';
    public const NIN = 'nin';

    public const ORDER_ASC = 'ASC';
    public const ORDER_DESC = 'DESC';

    public static function identifyOrderDirection(string $direction): string
    {
        if(!in_array($direction, [self::ORDER_ASC, self::ORDER_DESC])) {
            throw new InvalidArgumentException('Invalid order direction.');
        }

        return self::ORDER_DESC == $direction ? '-' : '+';
    }

    public static function checkAvailabilityOfComparison(string $comparison): bool
    {
        return in_array($comparison, [
            self::EQUAL,
            self::NOT_EQUAL,
            self::GREATER_THAN,
            self::GREATER_OR_EQUAL_THEN,
            self::LESS_THEN,
            self::LESS_OR_EQUAL_THEN,
            self::IN,
            self::NIN
        ]);
    }


}