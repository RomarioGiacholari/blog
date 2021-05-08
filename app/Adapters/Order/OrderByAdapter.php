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
        $allowedDirections = static::getAllowedDirections();
        $defaultDirection = $allowedDirections[0];
        $direction = $request->query('direction') ?? $defaultDirection;

        if (!in_array($direction, $allowedDirections)) {
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

        if (trim($key) !== '' && !empty($keys[$key])) {
            $internalKey = $keys[$key];
        }

        return $internalKey;
    }

    private static function getAllowedDirections(): array
    {
        return ['desc', 'asc'];
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
