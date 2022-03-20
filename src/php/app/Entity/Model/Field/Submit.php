<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Submit extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeString('button_value', 'true');
        $this->parseAttributeString('button_text', $this->getAttributeString('name'));

        parent::setup();
    }

    public function renderInput(): string
    {
        $this->getForm()->addInput($this->getAttributeString('name'), $this);

        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Submit.twig', [
                'id'           => $this->id,
                'field_name'   => $this->field_name,
                'button_value' => $this->getAttribute('button_value'),
                'button_text'  => $this->getAttribute('button_text'),
            ]);
    }
}
