<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

use IWA_FormBuilder\Tools\InheritAttributeManager\Main as InheritAttributeManager;

trait CorePropertyTrait
{
    protected array $properties = [];

    ////////////////////////////////////////////////////////////////////

    public function issetProperty(string $name): bool
    {
        return InheritAttributeManager::issetAttribute($this->properties, $name);
    }

    public function setProperty(string $name, mixed $value): void
    {
        InheritAttributeManager::setAttribute($this->properties, $name, $value);
    }

    public function getPropertyInteger(string $name, int $default = null): int
    {
        return InheritAttributeManager::getAttributeInteger($this->properties, $name, $default);
    }

    public function getPropertyBoolean(string $name, bool $default = null): bool
    {
        return InheritAttributeManager::getAttributeBoolean($this->properties, $name, $default);
    }

    public function getPropertyString(string $name, string $default = null): string
    {
        return InheritAttributeManager::getAttributeString($this->properties, $name, $default);
    }

    public function getPropertyArray(string $name, array $default = null): array
    {
        return InheritAttributeManager::getAttributeArray($this->properties, $name, $default);
    }


    public function parsePropertyInteger(string $name, ?int $default = null): void
    {
        InheritAttributeManager::parseAttributeInteger($this->properties, $name, $default);
    }

    public function parsePropertyBoolean(string $name, ?bool $default = null): void
    {
        InheritAttributeManager::parseAttributeBoolean($this->properties, $name, $default);
    }

    public function parsePropertyString(string $name, ?string $default = null, bool $lang_parse = false): void
    {
        InheritAttributeManager::parseAttributeString($this->properties, $name, $default, $lang_parse);
    }

    public function parsePropertyArray(string $name, ?array $default = null): void
    {
        InheritAttributeManager::parseAttributeArray($this->properties, $name, $default);
    }
}
