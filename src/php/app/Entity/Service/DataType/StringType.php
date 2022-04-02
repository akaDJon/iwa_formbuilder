<?php

namespace IWA_FormBuilder\Entity\Service\DataType;

class StringType extends \IWA_FormBuilder\Entity\Service\DataType\Abstract\CoreType
{
    public static function isEmpty(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): bool
    {
        if ($postvalue === '') {
            return true;
        }

        return false;
    }
}
