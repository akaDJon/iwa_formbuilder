<?php

namespace IWA_FormBuilder\Tools\InheritAttributeManager;

class Main
{
    protected static function checkAttribute(array &$attributes, string $name, mixed $default): void
    {
        if (is_null($default) and (!static::issetAttribute($attributes, $name))) {
            throw new CheckAttributeException('Attribute "' . $name . '" is not set and Default is null');
        }
    }

    public static function issetAttribute(array &$attributes, string $name): bool
    {
        return isset($attributes[$name]);
    }

    public static function setAttribute(array &$attributes, string $name, mixed $value): void
    {
        /** @psalm-suppress MixedAssignment */
        $attributes[$name] = $value;
    }

    protected static function getAttribute(array &$attributes, string $name, mixed $default = null): mixed
    {
        return $attributes[$name] ?? $default;
    }


    public static function getAttributeInteger(array &$attributes, string $name, int $default = null): int
    {
        static::checkAttribute($attributes, $name, $default);

        return (int)static::getAttribute($attributes, $name, $default);
    }

    public static function getAttributeBoolean(array &$attributes, string $name, bool $default = null): bool
    {
        static::checkAttribute($attributes, $name, $default);

        return (bool)static::getAttribute($attributes, $name, $default);
    }

    public static function getAttributeString(array &$attributes, string $name, string $default = null): string
    {
        static::checkAttribute($attributes, $name, $default);

        return (string)static::getAttribute($attributes, $name, $default);
    }

    public static function getAttributeArray(array &$attributes, string $name, array $default = null): array
    {
        static::checkAttribute($attributes, $name, $default);

        return (array)static::getAttribute($attributes, $name, $default);
    }

//    public static function parseAttribute(array &$attributes, string $name, mixed $default = null): void
//    {
//        if (!static::issetAttribute($attributes, $name)) {
//            static::setAttribute($attributes, $name, $default);
//        }
//
//        static::setAttribute($attributes, $name, static::getAttribute($attributes, $name));
//    }

    public static function parseAttributeInteger(array &$attributes, string $name, ?int $default = null): void
    {
        if (!static::issetAttribute($attributes, $name)) {
            static::setAttribute($attributes, $name, $default);
        }

        if (static::issetAttribute($attributes, $name)) {
            static::setAttribute($attributes, $name, (int)static::getAttribute($attributes, $name));
        }
    }

    public static function parseAttributeBoolean(array &$attributes, string $name, ?bool $default = null): void
    {
        if (!static::issetAttribute($attributes, $name)) {
            static::setAttribute($attributes, $name, $default);
        } else {
            if ($default === false) {
                $value = (
                    static::getAttributeBoolean($attributes, $name, false) === true or
                    static::getAttributeString($attributes, $name, '') === 'true' or
                    static::getAttributeString($attributes, $name, '') === 'yes' or
                    static::getAttributeString($attributes, $name, '') === 'on' or
                    static::getAttributeString($attributes, $name, '') === '1' or
                    static::getAttributeInteger($attributes, $name, 0) === 1
                );

                static::setAttribute($attributes, $name, $value);
            }

            if ($default === true) {
                $value = (
                    static::getAttributeBoolean($attributes, $name, true) === false or
                    static::getAttributeString($attributes, $name, '') === 'false' or
                    static::getAttributeString($attributes, $name, '') === 'no' or
                    static::getAttributeString($attributes, $name, '') === 'off' or
                    static::getAttributeString($attributes, $name, '') === '0' or
                    static::getAttributeInteger($attributes, $name, 1) === 0
                );

                static::setAttribute($attributes, $name, !$value);
            }
        }
    }

    public static function parseAttributeString(array &$attributes, string $name, ?string $default = null, bool $lang_parse = false): void
    {
        if (!static::issetAttribute($attributes, $name)) {
            static::setAttribute($attributes, $name, $default);
        }

        if (static::issetAttribute($attributes, $name)) {
            static::setAttribute($attributes, $name, (string)static::getAttribute($attributes, $name));
        }

        if (static::issetAttribute($attributes, $name)) {
            if ($lang_parse) {
                $message = static::getAttributeString($attributes, $name, '');
                $trans = \IWA_FormBuilder\Entity\Service\TranslatorManager::trans($message);
                static::setAttribute($attributes, $name, $trans);
            }
        }
    }

    public static function parseAttributeArray(array &$attributes, string $name, ?array $default = null): void
    {
        if (!static::issetAttribute($attributes, $name)) {
            static::setAttribute($attributes, $name, $default);
        }

        if (static::issetAttribute($attributes, $name)) {
            static::setAttribute($attributes, $name, (array)static::getAttribute($attributes, $name));
        }
    }
}
