<?php

namespace IWA_FormBuilder\Entity\Service\DataFilter\Interface;

interface FilterInterface
{
    public static function run(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed;
}
