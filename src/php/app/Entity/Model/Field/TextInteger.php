<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class TextInteger extends \IWA_FormBuilder\Entity\Model\Field\Text
{
    protected function setup(): void
    {
        $this->parsePropertyString('data_type', 'int');
        $this->parsePropertyString('data_converter_database', 'number');

        parent::setup();
    }
}
