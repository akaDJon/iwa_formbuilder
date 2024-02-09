<?php

namespace IWA_FormBuilder\Entity\Service\DataValidator;

class RequireValidator implements \IWA_FormBuilder\Entity\Service\DataValidator\Interface\DataValidatorInterface
{
    public static function check(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue, array $options): string|bool
    {
        $dataType = $entity->getDataType();

        if (!isset($dataType)) {
            throw new \Exception(sprintf('dataType is not set in class "%s"', $entity::class));
        }

        if ($dataType::isEmpty($entity, $postvalue)) {
            $validate_messages = $entity->getAttributeString('validate_messages', '');
            $rules                 = \IWA_FormBuilder\Tools\FriendlyStringParser::parse($validate_messages);
            $message               = (string)($rules['require']['params'][0] ?? 'validate.require.default');

            return \IWA_FormBuilder\Entity\Service\TranslatorManager::trans($message);
        }

        return true;
    }
}
