<?php

namespace IWA_FormBuilder\Form\Format;

class Yaml extends PhpArray
{
    public \IWA_FormBuilder\Entity $entity;

    public function __construct(string $yaml)
    {
        $array = (array)\Symfony\Component\Yaml\Yaml::parse($yaml);

        parent::__construct($array);
    }
}
