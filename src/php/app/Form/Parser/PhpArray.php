<?php

namespace IWA_FormBuilder\Form\Parser;

class PhpArray extends PhpObject
{
    protected function prepareSource(mixed $source): \IWA_FormBuilder\Entity
    {
        if (!is_array($source)) {
            throw new \Exception('$source is not array');
        }

        $source = static::recursiveArr2Obj($source);

        if (!$source instanceof \IWA_FormBuilder\Entity) {
            throw new \Exception('recursiveArr2Obj is wrong');
        }

        return $source;
    }

    public static function recursiveArr2Obj(array $array): \IWA_FormBuilder\Entity|array
    {
        /**
         * @var array<array|string> $array
         */
        if (isset($array['entity'])) {
            if (isset($array['children']) and is_array($array['children']) and !empty($array['children'])) {
                /** @var array $child */
                foreach ($array['children'] as $key => $child) {
                    $array['children'][$key] = static::recursiveArr2Obj($child);
                }
            }

            return new \IWA_FormBuilder\Entity($array);
        } else {
            return $array;
        }
    }
}
