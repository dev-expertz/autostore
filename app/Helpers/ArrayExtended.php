<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class ArrayExtended
{
    /**
     * Return first that match `$key == $values`.
     *
     * @param mixed[] $source
     * @param string $key
     * @param int|string $needleValue
     * @return mixed|null
     */
    public static function first(array $source, string $key, string $needleValue)
    {
        if (count($source) == 0) {
            return null;
        }
        $isObject = is_object($source[0]);

        foreach ($source as $item) {
            $value = $isObject ? $item->$key : $item[$key];
            if ($value == $needleValue) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Normalizes array.
     * @param $arr
     * @return array|null
     */
    public static function normalize(array $arr): ?array
    {
        $out = array_values(array_unique($arr));
        if (empty($out)) {
            return null;
        }

        return $out;
    }

    /**
     * Return list of ints, exploded by glue.
     * @param string $data
     * @param string $delimether
     * @return array|null
     */
    public static function getInts(string $data, string $delimether): ?array
    {
        return array_map('intval', explode($delimether, $data));
    }

    /**
     * Return list of ints, exploded by glue.
     * @param string $data
     * @param string $delimether
     * @return array|null
     */
    public static function applyEmptyOnElements(array $arr): array
    {
        return array_map('self::_emptyElement', $arr);
    }

    private static function _emptyElement($el)
    {
        return empty($el) ? null : $el;
    }

    /**
     * The ArrExtended::wrapElements method wraps each element of the array in it.
     * @param array $array
     * @param string $start
     * @param string $end
     * @return string[] with formatted elements.
     */
    public static function wrapElements(array $data, string $start, string $end): ?array
    {
        if (is_null($data)) {
            return null;
        }
        $out = [];
        foreach ($data as $el) {
            $out[] = $start.$el.$end;
        }

        return $out;
    }

    /**
     * Create multi-dimentional array, based on property by batching assoc array or array of obj.
     * [["key" => 'a', "payload" => 2], ["key" => 'a', "payload" => 3], ["key" => 'b', "payload" => 2]] will become
     * ['a' => [["key" => 'a', "payload" => 2], ["key" => 'a', "payload" => 3]], 'b' => [["key" => 'b', "payload" => 2]]].
     * @param array $list
     * @param $key
     * @return array
     */
    public static function batchByProperty(array $list, string $key): array
    {
        $leading = Arr::pluck($list, $key);
        $out = [];
        foreach ($leading as $l) {
            $out[$l] = [];
        }

        foreach ($list as $item) {
            $value = is_object($item) ? $item->$key : $item[$key];
            $out[$value][] = $item;
        }

        return $out;
    }

    /**
     * Removes null values from array.
     *
     * @param array $data
     * @return array
     */
    public static function filterNulls(array $data): array
    {
        return array_filter($data, function ($value) {
            return ! is_null($value);
        });
    }

    public static function removeFirstStringElement(array $data, string $needle): array
    {
        $key = array_search($needle, $data);
        unset($data[$key]);

        return array_values($data);
    }
}