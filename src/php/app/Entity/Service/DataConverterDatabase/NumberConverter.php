<?php

namespace IWA_FormBuilder\Entity\Service\DataConverterDatabase;

class NumberConverter implements \IWA_FormBuilder\Entity\Service\DataConverterDatabase\Interface\DataConverterDatabaseInterface
{
    // string to num
    public static function convertPost2Database(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        $databasevalue = preg_replace("/[ | ]+/", '', trim((string)$postvalue));

        return $databasevalue;
    }

    // num to string
    public static function convertDatabase2Post(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $databasevalue): mixed
    {
        $postvalue = number_format((float)$databasevalue, 0, ".", ' ');

        return $postvalue;
    }
}
