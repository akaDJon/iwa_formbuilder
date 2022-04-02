<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Text extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parsePropertyString('dataType', 'string');
        $this->parseAttributeString('dataFilter', 'safe|trim');
        $this->parseAttributeBoolean('autocomplete', false);

        parent::setup();
    }

    protected function renderInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Text.twig', [
                'id'            => $this->getHtmlId(),
                'htmlInputName' => $this->getHtmlInputName(),
                'value'         => $this->getValue(),
                'required'      => $this->getAttributeBoolean('required'),
                'readonly'      => $this->getAttributeBoolean('readonly'),
                'disabled'      => $this->getAttributeBoolean('disabled'),
                'autocomplete'  => $this->getAttributeBoolean('autocomplete'),
            ]);
    }
}
