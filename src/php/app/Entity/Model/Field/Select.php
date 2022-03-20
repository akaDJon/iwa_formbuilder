<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Select extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    public function renderInput(): string
    {
        $this->getForm()->addInput($this->getAttributeString('name'), $this);

        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Select.twig', [
                'id'         => $this->id,
                'field_name' => $this->field_name,
                'value'      => '',
                'options'    => $this->getAttribute('options'),
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
