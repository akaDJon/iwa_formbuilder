<?php

namespace IWA_FormBuilder\Entity\Model;

class FieldTextDouble extends \IWA_FormBuilder\Entity\Model\Abstract\Subform
{
    protected function subform(): \IWA_FormBuilder\Form\Form
    {
        $subform = new \IWA_FormBuilder\Form\Form($this->getForm(), \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBINPUT);
        $subform->setPrefix($this->getAttributeString('name'));

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'join',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'field_text',
                    'name'     => 'subtext1',
                    'label'    => 'field1',
                    'validate' => 'min:10|max:500',
                ]),
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'field_text',
                    'name'     => 'subtext2',
                    'label'    => 'field2',
                    'validate' => 'min:500',
                ]),
            ],
        ]);

        $subform->parse('object', $source);

        return $subform;
    }
}
