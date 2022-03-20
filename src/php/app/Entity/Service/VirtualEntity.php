<?php

namespace IWA_FormBuilder\Entity\Service;

class VirtualEntity
{
    public string $entityname;
    public array $attributes;
    public array $children;

    public function __construct(array $attributes = [])
    {
        $this->entityname = (string)$attributes['entity'];
        $this->children   = (array)($attributes['children'] ?? []);

        unset($attributes['entity']);
        unset($attributes['children']);
        $this->attributes = $attributes;
    }
}
