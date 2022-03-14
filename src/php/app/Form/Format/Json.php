<?php

namespace IWA_FormBuilder\Form\Format;

class Json extends PhpArray
{
    public \IWA_FormBuilder\Entity $entity;

    public function __construct(string $json)
    {
        $array = (array)json_decode($json, true);

        parent::__construct($array);
    }
}
