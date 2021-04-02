<?php


namespace ViaAPI\ViaSdkPhp\Constants;


class StatusConstants
{
    public const STATUS_WAITING = 'w';
    public const STATUS_ACTIVE = 'a';
    public const STATUS_INACTIVE = 'i';
    public const STATUS_DELETED = 'd';

    public static function isAvailableStatus(string $status): bool
    {
        return in_array($status, [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
            self::STATUS_WAITING,
            self::STATUS_DELETED
        ]);
    }
}