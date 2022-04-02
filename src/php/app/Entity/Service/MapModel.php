<?php

namespace IWA_FormBuilder\Entity\Service;

class MapModel extends \IWA_FormBuilder\Tools\MapManager
{
    protected static array $items = [
        // Widget
        'forms'             => \IWA_FormBuilder\Entity\Model\Widget\Forms::class,
        'form'              => \IWA_FormBuilder\Entity\Model\Widget\Form::class,
        'fieldset'          => \IWA_FormBuilder\Entity\Model\Widget\Fieldset::class,
        'join'              => \IWA_FormBuilder\Entity\Model\Widget\Join::class,
        'repeatableform'    => \IWA_FormBuilder\Entity\Model\Widget\RepeatableForm::class,
        'div'               => \IWA_FormBuilder\Entity\Model\Widget\Div::class,
        'columns'           => \IWA_FormBuilder\Entity\Model\Widget\Columns::class,
        // Field
        'field_text'        => \IWA_FormBuilder\Entity\Model\Field\Text::class,
        'field_textinteger' => \IWA_FormBuilder\Entity\Model\Field\TextInteger::class,
        'field_select'      => \IWA_FormBuilder\Entity\Model\Field\Select::class,
        'field_hidden'      => \IWA_FormBuilder\Entity\Model\Field\Hidden::class,
        'field_submit'      => \IWA_FormBuilder\Entity\Model\Field\Submit::class,
        // Examples
        'field_textdouble'  => \IWA_FormBuilder\Entity\Model\FieldTextDouble::class,
        'field_texttriple'  => \IWA_FormBuilder\Entity\Model\FieldTextTriple::class,
        'field_textform'    => \IWA_FormBuilder\Entity\Model\FieldTextForm::class,
    ];
}
