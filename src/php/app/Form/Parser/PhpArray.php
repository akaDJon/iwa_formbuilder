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
            $obj = new \IWA_FormBuilder\Entity($array);
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    $obj->attributes[$k] = static::recursiveArr2Obj($v);
                }
            }

            return $obj;
        } else {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    $array[$k] = static::recursiveArr2Obj($v);
                }
            }

            return $array;
        }
    }
}
