<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class TextInteger extends \IWA_FormBuilder\Entity\Model\Field\Text
{
    protected function setup(): void
    {
        $this->parsePropertyString('dataType', 'int');
        $this->parsePropertyString('dataConverterDatabase', 'number');

        parent::setup();
    }
}
