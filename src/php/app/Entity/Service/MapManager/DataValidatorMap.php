<?php

namespace IWA_FormBuilder\Entity\Service\MapManager;

class DataValidatorMap extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $items = [
        'none'    => \IWA_FormBuilder\Entity\Service\DataValidator\NoneValidator::class,
        'min'     => \IWA_FormBuilder\Entity\Service\DataValidator\MinValidator::class,
        'max'     => \IWA_FormBuilder\Entity\Service\DataValidator\MaxValidator::class,
        'require' => \IWA_FormBuilder\Entity\Service\DataValidator\RequireValidator::class,
    ];
}
