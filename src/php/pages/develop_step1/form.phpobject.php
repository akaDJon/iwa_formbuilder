<?php

return new IWA_FormBuilder\Entity([
    'entity'   => 'form',
    'version'  => '2',
    'children' => [
        new IWA_FormBuilder\Entity([
            'entity'   => 'fieldset',
            'name'     => 'main',
            'children' => [
                new IWA_FormBuilder\Entity([
                    'entity' => 'field_text',
                    'name'   => 'text',
                    'label'  => 'текстовое поле',
                ]),
                new IWA_FormBuilder\Entity([
                    'entity'   => 'field_list',
                    'name'     => 'list',
                    'label'    => 'С описанием',
                    'children' => [
                        new IWA_FormBuilder\Entity([
                            'entity' => 'option',
                            'value'  => '1',
                            'text'   => 'Значение 1',
                        ]),
                        new IWA_FormBuilder\Entity([
                            'entity' => 'option',
                            'value'  => '2',
                            'text'   => 'Значение 2',
                        ]),
                        new IWA_FormBuilder\Entity([
                            'entity' => 'option',
                            'value'  => '3',
                            'text'   => 'Значение 3',
                        ]),
                    ],
                ]),
            ],
        ]),
    ],
]);
