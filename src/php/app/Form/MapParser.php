<?php

namespace IWA_FormBuilder\Form;

class MapParser extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $items = [
        'xml'    => \IWA_FormBuilder\Form\Parser\Xml::class,
        'object' => \IWA_FormBuilder\Form\Parser\PhpObject::class,
        'array'  => \IWA_FormBuilder\Form\Parser\PhpArray::class,
        'json'   => \IWA_FormBuilder\Form\Parser\Json::class,
        'yaml'   => \IWA_FormBuilder\Form\Parser\Yaml::class,
    ];
}
