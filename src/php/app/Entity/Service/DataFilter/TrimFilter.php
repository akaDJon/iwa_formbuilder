<?php

namespace IWA_FormBuilder\Entity\Service\DataFilter;

class TrimFilter implements \IWA_FormBuilder\Entity\Service\DataFilter\Interface\FilterInterface
{
    public static function run(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        $postvalue = (string)$postvalue;
        $postvalue = trim($postvalue);

        return $postvalue;
    }
}
