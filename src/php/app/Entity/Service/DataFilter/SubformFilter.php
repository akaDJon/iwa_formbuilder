<?php

namespace IWA_FormBuilder\Entity\Service\DataFilter;

class SubformFilter implements \IWA_FormBuilder\Entity\Service\DataFilter\Interface\FilterInterface
{
    public static function run(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        return $postvalue;
    }
}
