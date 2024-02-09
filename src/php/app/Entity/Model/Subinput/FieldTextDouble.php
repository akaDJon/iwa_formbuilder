<?php

namespace IWA_FormBuilder\Entity\Model\Subinput;

class FieldTextDouble extends \IWA_FormBuilder\Entity\Model\Abstract\Subinput
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

        $this->subform->parse('object', $source);
    }
}
