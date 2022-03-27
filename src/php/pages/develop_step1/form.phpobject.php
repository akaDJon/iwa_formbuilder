<?php

return new \IWA_FormBuilder\Entity([
    'entity'   => 'forms',
    'version'  => '2',
    'children' => [
        new \IWA_FormBuilder\Entity([
            'entity'   => 'form',
            'name'     => 'main',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity' => 'field_text',
                    'name'   => 'text',
                    'label'  => 'текстовое поле',
                ]),
                new \IWA_FormBuilder\Entity([
                    'entity'  => 'field_select',
                    'name'    => 'list',
                    'label'   => 'С описанием',
                    'options' => [
                        ['value' => '1', 'text' => 'Значение 1'],
                        ['value' => '2', 'text' => 'Значение 2'],
                        ['value' => '3', 'text' => 'Значение 3'],
                    ],
                ]),
            ],
        ]),
    ],
]);
