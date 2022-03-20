<?php

namespace IWA_FormBuilder\Entity\Model;

class FieldTextForm extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    public function renderInput(): string
    {
//        $this->getForm()->addInput($this->getAttributeString('name'), $this);

        $form = $this->getForm();

        // example xml form
//        $source = file_get_contents(ROOTPROJECT . '/src/php/pages/develop_step1/form.xml');
//        return $form->parseAndRender('xml', $source);

        // example object form
        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'join',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity' => 'field_text',
                    'label'  => 'field1',
                    'name'   => $this->getAttributeString('name') . '_1',
                ]),
                new \IWA_FormBuilder\Entity([
                    'entity' => 'field_text',
                    'label'  => 'field2',
                    'name'   => $this->getAttributeString('name') . '_2',
                ]),
            ],
        ]);

        return $form->parseAndRender('object', $source);
    }
}
