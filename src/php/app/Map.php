<?php

namespace IWA_FormBuilder;

class Map
{
    public static function get(): array
    {
        return [
            'form'       => \IWA_FormBuilder\Entity\Form::class,
            'fieldset'   => \IWA_FormBuilder\Entity\Fieldset::class,
            'field_text' => \IWA_FormBuilder\Entity\FieldText::class,
            'field_list' => \IWA_FormBuilder\Entity\FieldList::class,
        ];
    }
}
