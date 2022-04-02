<?php

namespace IWA_FormBuilder\Tools;

class MapManager
{
    protected static array $items = [];

    ///////////////////////////////////////////////////

    public static function getItems(): array
    {
        return static::$items;
    }

    public static function addItems(array $array): void
    {
        static::$items = array_merge(static::$items, $array);
    }

    public static function setItems(array $items): void
    {
        static::$items = $items;
    }

    ///////////////////////////////////////////////////

    public static function issetItem(string $id): bool
    {
        return (isset(static::$items[$id]));
    }

    public static function getItem(string $id): string
    {
        return (string)static::$items[$id];
    }

    public static function setItem(string $id, string $class): void
    {
        static::$items[$id] = $class;
    }

    public static function addItem(string $id, string $class): void
    {
        static::$items[$id] = $class;
    }

    public static function removeItem(string $id): void
    {
        unset(static::$items[$id]);
    }

    ///////////////////////////////////////////////////

    protected static function checkClass(string $id): void
    {
        if (!static::issetItem($id)) {
            throw new \Exception('Class "' . static::class . '" id "' . $id . '" not found');
        }
    }

    public static function getObject(string $id, array $params = []): object
    {
        static::checkClass($id);

        $class = static::getItem($id);

        return new $class(...$params);
    }
}
