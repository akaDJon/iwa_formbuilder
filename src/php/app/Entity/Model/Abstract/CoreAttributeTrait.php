<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

use IWA_FormBuilder\Tools\InheritAttributeManager\Main as InheritAttributeManager;

trait CoreAttributeTrait
{
    protected array $attributes = [];

    ////////////////////////////////////////////////////////////////////

    public function issetAttribute(string $name): bool
    {
        return InheritAttributeManager::issetAttribute($this->attributes, $name);
    }

    public function setAttribute(string $name, mixed $value): void
    {
        InheritAttributeManager::setAttribute($this->attributes, $name, $value);
    }

    public function getAttributeInteger(string $name, int $default = null): int
    {
        return InheritAttributeManager::getAttributeInteger($this->attributes, $name, $default);
    }

    public function getAttributeBoolean(string $name, bool $default = null): bool
    {
        return InheritAttributeManager::getAttributeBoolean($this->attributes, $name, $default);
    }

    public function getAttributeString(string $name, string $default = null): string
    {
        return InheritAttributeManager::getAttributeString($this->attributes, $name, $default);
    }

    public function getAttributeArray(string $name, array $default = null): array
    {
        return InheritAttributeManager::getAttributeArray($this->attributes, $name, $default);
    }


    public function parseAttributeInteger(string $name, ?int $default = null): void
    {
        InheritAttributeManager::parseAttributeInteger($this->attributes, $name, $default);
    }

    public function parseAttributeBoolean(string $name, ?bool $default = null): void
    {
        InheritAttributeManager::parseAttributeBoolean($this->attributes, $name, $default);
    }

    public function parseAttributeString(string $name, ?string $default = null, bool $lang_parse = false): void
    {
        InheritAttributeManager::parseAttributeString($this->attributes, $name, $default, $lang_parse);
    }

    public function parseAttributeArray(string $name, ?array $default = null): void
    {
        InheritAttributeManager::parseAttributeArray($this->properties, $name, $default);
    }

//    protected function parseAttributeStringEnhanced(string $name, string $default = '', bool $lang_parse = false, string $prefix = '', string $postfix = ''): bool
//    {
//        $result = $this->parseAttributeString($name, $default, $lang_parse);
//
//        if ($result) {
//            $this->setAttribute($name, $prefix . ($this->getAttributeString($name)) . $postfix);
//        }
//
//        return $result;
//    }

}
