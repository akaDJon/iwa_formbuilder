<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Text extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    public function renderInput(): string
    {
        $this->getForm()->addInput($this->getAttributeString('name'), $this);

        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Text.twig', [
                'id'         => $this->id,
                'field_name' => $this->field_name,
                'value'      => '',
            ]);
    }
}
