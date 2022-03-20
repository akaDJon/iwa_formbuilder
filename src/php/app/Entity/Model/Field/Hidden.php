<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Hidden extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeBoolean('field_hidden', true);

        parent::setup();
    }

    public function renderInput(): string
    {
        $this->getForm()->addInput($this->getAttributeString('name'), $this);

        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Hidden.twig', [
                'id'         => $this->id,
                'field_name' => $this->field_name,
                'value'      => '',
            ]);
    }
}
