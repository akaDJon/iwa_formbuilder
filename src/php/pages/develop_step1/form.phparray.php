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
                    'entity'  => 'field_list',
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
