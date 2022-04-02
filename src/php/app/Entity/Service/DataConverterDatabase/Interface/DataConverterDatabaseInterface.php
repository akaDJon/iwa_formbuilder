<?php

namespace IWA_FormBuilder\Entity\Service\DataConverterDatabase\Interface;

interface DataConverterDatabaseInterface
{
    public static function convertPost2Database(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed;

    public static function convertDatabase2Post(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $databasevalue): mixed;
}
