<?php

namespace IWA_FormBuilder\Entity\Service\DataFilter;

class UnsetFilter implements \IWA_FormBuilder\Entity\Service\DataFilter\Interface\FilterInterface
{
    public static function run(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        return false;
    }
}
