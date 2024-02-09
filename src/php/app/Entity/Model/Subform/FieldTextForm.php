<?php

namespace IWA_FormBuilder\Entity\Model\Subform;

class FieldTextForm extends \IWA_FormBuilder\Entity\Model\Abstract\Subform
{
    protected function subformParse(): void
    {
        if (is_null($this->subform)) {
            throw new \Exception('subform is null');
        }

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'join',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'field_textinteger',
                    'name'     => 'textform_textinteger',
                    'label'    => 'subtext1 (textinteger)',
                    'validate' => 'min:10|max:500',
                    'required' => 'true',
                ]),
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'field_text',
                    'name'     => 'textform_text',
                    'label'    => 'subtext2 (text)',
                    'required' => 'true',
                ]),
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'field_select',
                    'name'     => 'textform_select',
                    'label'    => 'list (select)',
                    'required' => 'true',
                    'options'  => [
                        ['value' => '1', 'text' => 'Значение 1'],
                        ['value' => '2', 'text' => 'Значение 2'],
                        ['value' => '3', 'text' => 'Значение 3'],
                    ],
                ]),
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'field_select',
                    'name'     => 'textform_multiple',
                    'label'    => 'multiple (select)',
                    'multiple' => 'true',
                    'required' => 'true',
                    'options'  => [
                        ['value' => '1', 'text' => 'Значение 1'],
                        ['value' => '2', 'text' => 'Значение 2'],
                        ['value' => '3', 'text' => 'Значение 3'],
                    ],
                ]),
            ],
        ]);

        $this->subform->parse('object', $source);
    }
}
