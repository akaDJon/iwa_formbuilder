<?php

namespace IWA_FormBuilder\Entity\Service;

class MapFilter extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $map = [
        'subform'  => \IWA_FormBuilder\Entity\Service\Filter\SubformFilter::class,
        'raw'      => \IWA_FormBuilder\Entity\Service\Filter\RawFilter::class,
        'trim'     => \IWA_FormBuilder\Entity\Service\Filter\TrimFilter::class,
        'safe'     => \IWA_FormBuilder\Entity\Service\Filter\SafeFilter::class,
        'safeHTML' => \IWA_FormBuilder\Entity\Service\Filter\SafeHTMLFilter::class,
        'unset'    => \IWA_FormBuilder\Entity\Service\Filter\UnsetFilter::class,
        'cmd'      => \IWA_FormBuilder\Entity\Service\Filter\CmdFilter::class,
    ];
}
