<?php

namespace IWA_FormBuilder\Form\Format;

class PhpArray extends PhpObject
{
    public \IWA_FormBuilder\Entity $entity;

    public function __construct(array $array)
    {
        $entity = static::recursiveArr2Obj($array);

        if (!$entity instanceof \IWA_FormBuilder\Entity) {
            throw new \Exception('Не подходящий тип');
        }

        parent::__construct($entity);
    }

    public static function recursiveArr2Obj(array $array): \IWA_FormBuilder\Entity|array
    {
        if (isset($array['entity'])) {
            $obj = new \IWA_FormBuilder\Entity($array);
            /** @var mixed $v */
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    $obj->params[$k] = static::recursiveArr2Obj($v);
                }
            }

            return $obj;
        } else {
            /** @var mixed $v */
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    $array[$k] = static::recursiveArr2Obj($v);
                }
            }

            return $array;
        }
    }
}
