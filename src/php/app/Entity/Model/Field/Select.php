<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Select extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parsePropertyString('dataType', 'select');
        $this->parseAttributeString('dataFilter', 'cmd');
        $this->parseAttributeBoolean('multiple', false);

        $require = 'Требуется выбрать значение из списка';

        if ($this->getAttributeBoolean('multiple')) {
            $this->parsePropertyString('dataConverterDatabase', 'setarray');
            $require = 'Требуется выбрать хотя бы одно значение из списка';
        }

        $this->parseAttributeString('dataValidatorMessages', 'require:' . $require);

        parent::setup();
    }

    protected function renderInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Select.twig', [
                'id'            => $this->getHtmlId(),
                'htmlInputName' => ($this->getAttributeBoolean('multiple') ? $this->getHtmlInputName() . '[]' : $this->getHtmlInputName()),
                'value'         => $this->getValue(),
                'required'      => $this->getAttributeBoolean('required'),
                'readonly'      => $this->getAttributeBoolean('readonly'),
                'disabled'      => $this->getAttributeBoolean('disabled'),
                'multiple'      => $this->getAttributeBoolean('multiple'),
                'options'       => $this->getAttributeArray('options'),
            ]);
    }

    /** @psalm-suppress MoreSpecificReturnType */
    public static function xmlDeserialize(\IWA_FormBuilder\Entity\Service\Parse\Xml\Reader $reader): static
    {
        $self = parent::xmlDeserialize($reader);

        $self->xmlChildrenToAttributes([
            'options' => [
                'xmltag'             => 'option',
                'fnSetChildProperty' => function (array $child) {
                    return [
                        'value' => $child['attributes']['value'] ?? '',
                        'text'  => $child['value'] ?? '',
                    ];
                },
            ],
        ]);

        /** @psalm-suppress LessSpecificReturnStatement */
        return $self;
    }
}
