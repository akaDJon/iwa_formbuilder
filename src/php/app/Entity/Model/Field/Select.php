<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Select extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeString('filter', 'cmd');
        $this->parseAttributeBoolean('multiple', false);

        parent::setup();
    }

    protected function renderInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Select.twig', [
                'id'            => $this->getHtmlId(),
                'htmlInputName' => ($this->getAttributeBoolean('multiple') ? $this->getHtmlInputName() . '[]' : $this->getHtmlInputName()),
                'value'         => $this->getValue(),
                'options'       => $this->getAttribute('options'),
                'multiple'      => $this->getAttributeBoolean('multiple'),
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
