<?php

namespace IWA_FormBuilder\Entity\Service\DataValidator;

class RequireValidator implements \IWA_FormBuilder\Entity\Service\DataValidator\Interface\DataValidatorInterface
{
    public static function check(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue, array $options): string|bool
    {
        $dataType = $entity->getDataType();

        $dataValidatorMessages = $entity->getAttributeString('dataValidatorMessages', '');
        $rules                 = \IWA_FormBuilder\Tools\FriendlyStringParser::parse($dataValidatorMessages);
        $message               = $rules['require']['params'][0] ?? 'Значение не должно быть пустым';

        if (!isset($dataType)) {
            throw new \Exception(sprintf('dataType is not set in class "%s"', $entity::class));
        }

        if ($dataType::isEmpty($entity, $postvalue)) {
//            return 'Значение не должно быть пустым';
            return $message;
        }

        return true;
    }
}
