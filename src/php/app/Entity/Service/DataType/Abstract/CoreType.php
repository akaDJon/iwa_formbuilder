<?php

namespace IWA_FormBuilder\Entity\Service\DataType\Abstract;

abstract class CoreType
{
    abstract public static function isEmpty(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): bool;

    public static function toNum(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): int|float
    {
        throw new \Exception(sprintf('Class "%s" not supported convert to num', static::class));
    }
}
