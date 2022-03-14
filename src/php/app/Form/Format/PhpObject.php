<?php

namespace IWA_FormBuilder\Form\Format;

use IWA_FormBuilder\Form;

class PhpObject extends Form
{
    public \IWA_FormBuilder\Entity $entity;

    public function __construct(\IWA_FormBuilder\Entity $entity)
    {
        $this->entity = $entity;
    }

    public function generate(): string
    {
        dump($this->entity);

        $this->objecttree = $this->entity->parse();
        dump($this->objecttree);

        return '';
    }
}
