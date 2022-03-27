<?php

namespace IWA_FormBuilder\Entity\Model;

class FieldTextDouble extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeString('filter', 'subform');

        parent::setup();
    }

    protected function renderInput(): string
    {
        $subform = new \IWA_FormBuilder\Form\Form($this->getForm(), \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBINPUT);
        $subform->setPrefix($this->getAttributeString('name'));
        $subform->setData((array)$this->getValue());

        $field1 = $subform->parseAndRender(
            'object',
            new \IWA_FormBuilder\Entity([
                'entity' => 'field_text',
                'name'   => 'text1',
            ])
        );

        $field2 = $subform->parseAndRender(
            'object',
            new \IWA_FormBuilder\Entity([
                'entity' => 'field_text',
                'name'   => 'text2',
            ])
        );

        return $field1 . $field2;
    }
}
