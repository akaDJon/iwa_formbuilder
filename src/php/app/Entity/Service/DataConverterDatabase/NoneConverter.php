<?php

namespace IWA_FormBuilder\Entity\Service\DataConverterDatabase;

class NoneConverter implements \IWA_FormBuilder\Entity\Service\DataConverterDatabase\Interface\DataConverterDatabaseInterface
{
    public static function convertPost2Database(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        return $postvalue;
    }

    public static function convertDatabase2Post(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $databasevalue): mixed
    {
        return $databasevalue;
    }
}
