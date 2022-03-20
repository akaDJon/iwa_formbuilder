<?php

namespace IWA_FormBuilder\Form\Parser;

class Json extends PhpArray
{
    protected function prepareSource(mixed $source): \IWA_FormBuilder\Entity
    {
        if (!is_string($source)) {
            throw new \Exception('$source is not string');
        }

        /** @var array|null|bool $source */
        $source = json_decode($source, true);

        if (!is_array($source)) {
            throw new \Exception('json is wrong');
        }

        return parent::prepareSource($source);
    }
}
