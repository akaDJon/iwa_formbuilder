<?php

return [
    'entity'   => 'form',
    'version'  => '2',
    'children' => [
        [
            'entity'   => 'fieldset',
            'name'     => 'main',
            'children' => [
                [
                    'entity' => 'field_text',
                    'name'   => 'text',
                    'label'  => 'текстовое поле',
                ],
                [
                    'entity'   => 'field_list',
                    'name'     => 'list',
                    'label'    => 'С описанием',
                    'children' => [
                        [
                            'entity' => 'option',
                            'value'  => '1',
                            'text'   => 'Значение 1',
                        ],
                        [
                            'entity' => 'option',
                            'value'  => '2',
                            'text'   => 'Значение 2',
                        ],
                        [
                            'entity' => 'option',
                            'value'  => '3',
                            'text'   => 'Значение 3',
                        ],
                    ],
                ],
            ],
        ],
    ],
];