<?php

namespace IWA_FormBuilder\Entity\Service\DataValidator;

class MinValidator implements \IWA_FormBuilder\Entity\Service\DataValidator\Interface\DataValidatorInterface
{
    public static function check(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue, array $options): string|bool
    {
        if (!isset($options[0])) {
            throw new \Exception('MinValidator must have options');
        }

        $dataType = $entity->getDataType();

        if (!isset($dataType)) {
            throw new \Exception('is not set dataType');
        }

        if ($dataType::isEmpty($entity, $postvalue)) {
            return true;
        }

        $numvalue = $dataType::toNum($entity, $postvalue);
        $min      = (float)$options[0];

        if (!($numvalue >= $min)) {
            return sprintf('Значение должно быть больше или равно %s', $min);
        }

        return true;
    }
}
