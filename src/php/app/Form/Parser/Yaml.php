<?php

namespace IWA_FormBuilder\Form\Parser;

class Yaml extends PhpArray
{
    protected function prepareSource(mixed $source): \IWA_FormBuilder\Entity
    {
        if (!is_string($source)) {
            throw new \Exception('$source is not string');
        }

        /** @var array|null|bool $source */
        $source = \Symfony\Component\Yaml\Yaml::parse($source);

        if (!is_array($source)) {
            throw new \Exception('Yaml is wrong');
        }

        return parent::prepareSource($source);
    }
}
