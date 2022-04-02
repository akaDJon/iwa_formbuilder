<?php

namespace IWA_FormBuilder\Entity\Service\DataFilter;

class CmdFilter implements \IWA_FormBuilder\Entity\Service\DataFilter\Interface\FilterInterface
{
    public static function run(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        $pattern = '/[^A-Z0-9_]/i';

        $postvalue = (string)$postvalue;
        $postvalue = (string)preg_replace($pattern, '', $postvalue);

        return $postvalue;
    }
}
