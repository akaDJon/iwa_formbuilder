<?php

namespace IWA_FormBuilder\Entity\Service;

class VirtualEntity
{
    public string $entityName;
    public array $attributes;
    public array $children;

    public function __construct(array $attributes = [])
    {
        $this->entityName = (string)$attributes['entity'];
        $this->children   = (array)($attributes['children'] ?? []);

        unset($attributes['entity']);
        unset($attributes['children']);
        $this->attributes = $attributes;
    }
}
