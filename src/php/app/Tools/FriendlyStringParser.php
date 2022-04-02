<?php

namespace IWA_FormBuilder\Tools;

class FriendlyStringParser
{
    public static function parse(string $string): array
    {
        $result = [];

        $arr_rules = explode('|', $string);
        foreach ($arr_rules as $rule) {
            $pos = strpos($rule, ':');
            if ($pos === false) {
                $name   = $rule;
                $params = '';
            } else {
                $name   = substr($rule, 0, $pos);
                $params = substr($rule, $pos + 1);
            }

            $arr_params = [];

            if ($params !== '') {
                $arr_params = explode(',', $params);
            }

            $result[$name] = [
                'name'   => $name,
                'params' => $arr_params,
            ];
        }

        return $result;
    }
}
