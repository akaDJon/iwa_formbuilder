<?php

namespace IWA_FormBuilder;

class Entity
{
    public string $type;
    public array $params;

    public function __construct(array $params = [])
    {
        $this->type = (string)$params['entity'];

        unset($params['entity']);
        $this->params = $params;
    }

    public function parse(array $classMap = []): object
    {
        if (!empty($classMap)) {
            // чтобы родительская сущность могла указать на класс ее дочерней сущности
            $map = $classMap;
        } else {
            $map = \IWA_FormBuilder\Map::get();
        }

        /** @var string $class */
        $class = $map[$this->type];
        /** @psalm-suppress InvalidStringClass */
        $element = new $class();

        /** @var \IWA_FormBuilder\Entity\Abstract\Core $element */
        return $element->phpDeserialize($this->params);
    }
}
