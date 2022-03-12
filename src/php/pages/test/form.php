<?php

return new IWA_FormBuilder\Entity(
    'form',
    [
        'version'  => '2',
        'children' => [
            new IWA_FormBuilder\Entity(
                'fieldset',
                [
                    'name'     => 'main',
                    'children' => [
                        new IWA_FormBuilder\Entity(
                            'field_text',
                            [
                                'name'  => 'text',
                                'label' => 'текстовое поле',
                            ]
                        ),
                        new IWA_FormBuilder\Entity(
                            'field_list',
                            [
                                'name'     => 'list',
                                'label'    => 'С описанием',
                                'children' => [
                                    new IWA_FormBuilder\Entity(
                                        'option',
                                        [
                                            'value' => '1',
                                            'text'  => 'Значение 1',
                                        ]
                                    ),
                                    new IWA_FormBuilder\Entity(
                                        'option',
                                        [
                                            'value' => '2',
                                            'text'  => 'Значение 2',
                                        ]
                                    ),
                                    new IWA_FormBuilder\Entity(
                                        'option',
                                        [
                                            'value' => '3',
                                            'text'  => 'Значение 3',
                                        ]
                                    ),
                                ],
                            ]
                        ),
                    ],
                ]
            ),
        ],
    ]
);
