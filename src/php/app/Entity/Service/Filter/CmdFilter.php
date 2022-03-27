<?php

namespace IWA_FormBuilder\Entity\Service\Filter;

class CmdFilter implements \IWA_FormBuilder\Entity\Service\Filter\Interface\FilterInterface
{
    public function run(mixed $postvalue): mixed
    {
        $pattern = '/[^A-Z0-9_]/i';

        $postvalue = (string)$postvalue;
        $postvalue = (string) preg_replace($pattern, '', $postvalue);

        return $postvalue;
    }
}
