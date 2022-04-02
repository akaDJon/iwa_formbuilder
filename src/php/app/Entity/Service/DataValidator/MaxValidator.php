<?php

namespace IWA_FormBuilder\Entity\Service\DataValidator;

class MaxValidator implements \IWA_FormBuilder\Entity\Service\DataValidator\Interface\DataValidatorInterface
{
    public static function check(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue, array $options): string|bool
    {
        if (!isset($options[0])) {
            throw new \Exception('MaxValidator must have options');
        }

        $dataType = $entity->getDataType();

        if (!isset($dataType)) {
            throw new \Exception('is not set dataType');
        }

        if ($dataType::isEmpty($entity, $postvalue)) {
            return true;
        }

        $numvalue = $dataType::toNum($entity, $postvalue);
        $max      = (float)$options[0];

        if (!($numvalue <= $max)) {
            return sprintf('Значение должно быть меньше или равно %s', $max);
        }

        return true;
    }
}
