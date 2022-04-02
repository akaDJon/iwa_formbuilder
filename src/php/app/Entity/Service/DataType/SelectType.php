<?php

namespace IWA_FormBuilder\Entity\Service\DataType;

class SelectType extends \IWA_FormBuilder\Entity\Service\DataType\Abstract\CoreType
{
    public static function isEmpty(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): bool
    {
        if ($postvalue === '' or $postvalue === []) {
            return true;
        }

        return false;
    }
}
