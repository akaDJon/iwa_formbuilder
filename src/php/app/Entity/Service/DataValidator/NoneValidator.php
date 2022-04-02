<?php

namespace IWA_FormBuilder\Entity\Service\DataValidator;

class NoneValidator implements \IWA_FormBuilder\Entity\Service\DataValidator\Interface\DataValidatorInterface
{
    public static function check(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue, array $options): string|bool
    {
        return true;
    }
}
