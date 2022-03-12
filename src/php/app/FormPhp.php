<?php

namespace IWA_FormBuilder;

class FormPhp extends Form
{
    public \IWA_FormBuilder\Entity $entity;

    public function __construct(\IWA_FormBuilder\Entity $entity)
    {
        $this->entity = $entity;
    }

    public function generate(): string
    {
        $this->objecttree = $this->entity->parse();

        dump($this->objecttree);

        return '';
    }
}
