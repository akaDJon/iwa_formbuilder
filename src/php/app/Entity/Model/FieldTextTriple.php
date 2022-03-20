<?php

namespace IWA_FormBuilder\Entity\Model;

class FieldTextTriple extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    public function renderInput(): string
    {
//        $this->getForm()->addInput($this->getAttributeString('name'), $this);

        $forminput = $this->getForm()->getFormInput();

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
                'entity' => 'field_textdouble',
                'name'   => $this->getAttributeString('name') . '_2',
            ])
        );

        return $field1 . $field2;
    }
}
