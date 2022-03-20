<?php

namespace IWA_FormBuilder\Entity\Model;

class FieldTextDouble extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    public function renderInput(): string
    {
//        $this->getForm()->addInput($this->getAttributeString('name'), $this);

        $form      = $this->getForm();
        $forminput = $form->getFormInput();

        $field1 = $forminput->parseAndRender(
            'object',
            new \IWA_FormBuilder\Entity([
                'entity' => 'field_text',
                'name'   => $this->getAttributeString('name') . '_1',
            ])
        );

        $field2 = $forminput->parseAndRender(
            'object',
            new \IWA_FormBuilder\Entity([
                'entity' => 'field_text',
                'name'   => $this->getAttributeString('name') . '_2',
            ])
        );

        return $field1 . $field2;
    }
}
