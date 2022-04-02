<?php

namespace IWA_FormBuilder\Entity\Service;

class MapDataType extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $items = [
        'string' => \IWA_FormBuilder\Entity\Service\DataType\StringType::class,
        'int'    => \IWA_FormBuilder\Entity\Service\DataType\IntType::class,
        'select' => \IWA_FormBuilder\Entity\Service\DataType\SelectType::class,
    ];
}
