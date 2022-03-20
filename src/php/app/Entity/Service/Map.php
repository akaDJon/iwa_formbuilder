<?php

namespace IWA_FormBuilder\Entity\Service;

class Map
{
    public static function get(): array
    {
        return [
            // Widget
            'form'             => \IWA_FormBuilder\Entity\Model\Widget\Form::class,
            'fieldset'         => \IWA_FormBuilder\Entity\Model\Widget\Fieldset::class,
            'join'             => \IWA_FormBuilder\Entity\Model\Widget\Join::class,
            // Field
            'field_text'       => \IWA_FormBuilder\Entity\Model\Field\Text::class,
            'field_list'       => \IWA_FormBuilder\Entity\Model\Field\Select::class,
            'field_hidden'     => \IWA_FormBuilder\Entity\Model\Field\Hidden::class,
            'field_submit'     => \IWA_FormBuilder\Entity\Model\Field\Submit::class,
            // Examples
            'field_textdouble' => \IWA_FormBuilder\Entity\Model\FieldTextDouble::class,
            'field_texttriple' => \IWA_FormBuilder\Entity\Model\FieldTextTriple::class,
            'field_textform'   => \IWA_FormBuilder\Entity\Model\FieldTextForm::class,
        ];
    }
}
