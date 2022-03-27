<?php

namespace IWA_FormBuilder\Tools;

class MapManager
{
    protected static array $map = [];

    public static function get(): array
    {
        return static::$map;
    }

    public static function add(array $array): void
    {
        static::$map = array_merge(static::$map, $array);
    }

    public static function getClass(string $id): string
    {
        $map = static::$map;

        if (!isset($map[$id])) {
            throw new \Exception('unsupported map id');
        }

        return (string)$map[$id];
    }
}
