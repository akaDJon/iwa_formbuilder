<?php

return [
    'validate' => [
        'require' => [
            'default'         => 'Значение не должно быть пустым',
            'select_default'  => 'Требуется выбрать значение из списка',
            'select_multiple' => 'Требуется выбрать хотя бы одно значение из списка',
        ],
        'max' => [
            'default'         => 'Значение должно быть меньше или равно %max%',
        ],
        'min' => [
            'default'         => 'Значение должно быть больше или равно %min%',
        ],
    ],
    'label' => [
        'list' => 'Список',
    ],
];
