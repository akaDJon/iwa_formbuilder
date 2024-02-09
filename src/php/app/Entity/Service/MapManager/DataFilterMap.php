<?php

namespace IWA_FormBuilder\Entity\Service\MapManager;

class DataFilterMap extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $items = [
        'subform'  => \IWA_FormBuilder\Entity\Service\DataFilter\SubformFilter::class,
        'raw'      => \IWA_FormBuilder\Entity\Service\DataFilter\RawFilter::class,
        'trim'     => \IWA_FormBuilder\Entity\Service\DataFilter\TrimFilter::class,
        'safe'     => \IWA_FormBuilder\Entity\Service\DataFilter\SafeFilter::class,
        'safeHTML' => \IWA_FormBuilder\Entity\Service\DataFilter\SafeHTMLFilter::class,
        'unset'    => \IWA_FormBuilder\Entity\Service\DataFilter\UnsetFilter::class,
        'cmd'      => \IWA_FormBuilder\Entity\Service\DataFilter\CmdFilter::class,
    ];
}
