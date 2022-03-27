<?php

return [
    'entity'   => 'forms',
    'version'  => '2',
    'children' => [
        [
            'entity'   => 'form',
            'name'     => 'main',
            'children' => [
                [
                    'entity' => 'field_text',
                    'name'   => 'text',
                    'label'  => 'текстовое поле',
                ],
                [
                    'entity'  => 'field_select',
                    'name'    => 'list',
                    'label'   => 'С описанием',
                    'options' => [
                        [
                            'value' => '1',
                            'text'  => 'Значение 1',
                        ],
                        [
                            'value' => '2',
                            'text'  => 'Значение 2',
                        ],
                        [
                            'value' => '3',
                            'text'  => 'Значение 3',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
