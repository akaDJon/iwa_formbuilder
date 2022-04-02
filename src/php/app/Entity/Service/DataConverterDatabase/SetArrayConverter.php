<?php

namespace IWA_FormBuilder\Entity\Service\DataConverterDatabase;

class SetArrayConverter implements \IWA_FormBuilder\Entity\Service\DataConverterDatabase\Interface\DataConverterDatabaseInterface
{
    // array to set
    public static function convertPost2Database(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        $databasevalue = implode(',', (array)$postvalue);

        return $databasevalue;
    }

    // set to array
    public static function convertDatabase2Post(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $databasevalue): mixed
    {
        $postvalue = explode(',', (string)$databasevalue);

        return $postvalue;
    }
}
