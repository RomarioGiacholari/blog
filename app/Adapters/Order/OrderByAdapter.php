<?php

namespace App\Adapters\Order;

use Illuminate\Http\Request;

class OrderByAdapter
{
    public static function toKey(Request $request): string
    {
        $allowedKeys = static::getAllowedKeys();
        $default = $allowedKeys[0];
        $orderBy = $request->query('order-by') ?? $default;

        if (!in_array($orderBy, $allowedKeys)) {
            $orderBy = $default;
        }

        return $orderBy;
    }

    public static function toDirection(Request $request): string
    {
        $allowedDirection = static::getAllowedDirections();
        $defaultDirection = $allowedDirection[0];
        $direction = $request->query('direction') ?? $defaultDirection;

        if (!in_array($direction, $allowedDirection)) {
            $direction = $defaultDirection;
        }

        return $direction;
    }

    public static function toInternalKey(string $key): string
    {
        $allowedKeys = static::getAllowedKeys();
        $allowedInternalKeys = static::getAllowedInternalKeys();
        $internalKey = $allowedInternalKeys[0];
        $keys = array_combine($allowedKeys, $allowedInternalKeys);

        if (trim($key) !== '') {
            $internalKey = $keys[$key];
        }

        return $internalKey;
    }

    private static function getAllowedDirections(): array
    {
        return ['asc', 'desc'];
    }

    private static function getAllowedKeys(): array
    {
       return ['date', 'views'];
    }

    private static function getAllowedInternalKeys(): array
    {
        return ['created_at', 'views'];
    }
}
