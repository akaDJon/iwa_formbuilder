<?php

namespace IWA_FormBuilder\Entity\Service;

class MapDataValidator extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $items = [
        'none'    => \IWA_FormBuilder\Entity\Service\DataValidator\NoneValidator::class,
        'min'     => \IWA_FormBuilder\Entity\Service\DataValidator\MinValidator::class,
        'max'     => \IWA_FormBuilder\Entity\Service\DataValidator\MaxValidator::class,
        'require' => \IWA_FormBuilder\Entity\Service\DataValidator\RequireValidator::class,
    ];
}
