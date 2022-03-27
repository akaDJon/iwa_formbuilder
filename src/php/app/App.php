<?php

namespace IWA_FormBuilder;

class App
{
    private static string $rootDir;

    public static function appDemo(): string
    {
        return 'Hello world1';
    }

    public static function getRootPath(): string
    {
        static::$rootDir = ROOTPROJECT;
//        if (!isset(static::$rootDir)) {
//            $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
//
//            static::$rootDir = dirname($reflection->getFileName(), 2);
//        }

        return static::$rootDir;
    }

    public static function getTwig(): \Twig\Environment
    {
        $loader = new \Twig\Loader\FilesystemLoader(static::getRootPath() . '/src/php/app/Entity/Template');

        return new \Twig\Environment($loader);
    }
}
