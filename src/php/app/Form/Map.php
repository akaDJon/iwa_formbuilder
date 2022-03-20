<?php

namespace IWA_FormBuilder\Form;

class Map
{
    public static function get(): array
    {
        return [
            'xml'    => \IWA_FormBuilder\Form\Parser\Xml::class,
            'object' => \IWA_FormBuilder\Form\Parser\PhpObject::class,
            'array'  => \IWA_FormBuilder\Form\Parser\PhpArray::class,
            'json'   => \IWA_FormBuilder\Form\Parser\Json::class,
            'yaml'   => \IWA_FormBuilder\Form\Parser\Yaml::class,
        ];
    }
}
