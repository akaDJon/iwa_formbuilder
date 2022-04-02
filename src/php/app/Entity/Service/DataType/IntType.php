<?php

namespace IWA_FormBuilder\Entity\Service\DataType;

class IntType extends \IWA_FormBuilder\Entity\Service\DataType\Abstract\CoreType
{
    public static function isEmpty(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): bool
    {
        if ($postvalue === '' or $postvalue === '0' or $postvalue === 0) {
            return true;
        }

        return false;
    }

    public static function toNum(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): int|float
    {
        $value = preg_replace("/[ | ]+/", '', (string)$postvalue);

        if ((int)$value == $value) {
            return (int)$value;
        }

        if ((float)$value == $value) {
            return (float)$value;
        }

        return 0;
    }
}
