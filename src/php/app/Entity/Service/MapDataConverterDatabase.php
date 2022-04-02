<?php

namespace IWA_FormBuilder\Entity\Service;

class MapDataConverterDatabase extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $items = [
        'none'     => \IWA_FormBuilder\Entity\Service\DataConverterDatabase\NoneConverter::class,
        'setarray' => \IWA_FormBuilder\Entity\Service\DataConverterDatabase\SetArrayConverter::class,
        'number'   => \IWA_FormBuilder\Entity\Service\DataConverterDatabase\NumberConverter::class,
    ];
}
