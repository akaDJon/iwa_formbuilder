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
            $validate_messages = $entity->getAttributeString('validate_messages', '');
            $rules                 = \IWA_FormBuilder\Tools\FriendlyStringParser::parse($validate_messages);
            $message               = (string)($rules['max']['params'][0] ?? 'validate.max.default');
            $parameters = ['%max%' => $max];

            return \IWA_FormBuilder\Entity\Service\TranslatorManager::trans($message, $parameters);
        }

        return true;
    }
}
