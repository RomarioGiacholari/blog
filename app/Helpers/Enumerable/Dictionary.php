<?php

namespace App\Helpers\Enumerable;

class Dictionary
{
    public static function shuffle(array $dictionary): array
    {
        $shuffledDictionary = [];

        if (!empty($dictionary)) {
            $keys = array_keys($dictionary);
            $_ = shuffle($keys);

            foreach ($keys as $key) {
                $shuffledDictionary[$key] = $dictionary[$key];
            }
        }

        return $shuffledDictionary;
    }
}
