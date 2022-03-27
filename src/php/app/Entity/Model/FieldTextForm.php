<?php

namespace IWA_FormBuilder\Entity\Model;

class FieldTextForm extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeString('filter', 'subform');

        parent::setup();
    }

    protected function renderInput(): string
    {
        $subform = new \IWA_FormBuilder\Form\Form($this->getForm(), \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBFORM);
        $subform->setPrefix($this->getAttributeString('name'));
        $subform->setData((array)$this->getValue());

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
                    'name'   => 'text1',
                ]),
                new \IWA_FormBuilder\Entity([
                    'entity' => 'field_text',
                    'label'  => 'field2',
                    'name'   => 'text2',
                ]),
            ],
        ]);

        return $subform->parseAndRender('object', $source);
    }
}
