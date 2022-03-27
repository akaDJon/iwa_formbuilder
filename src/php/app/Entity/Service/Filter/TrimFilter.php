<?php

namespace IWA_FormBuilder\Entity\Service\Filter;

class TrimFilter implements \IWA_FormBuilder\Entity\Service\Filter\Interface\FilterInterface
{
    public function run(mixed $postvalue): mixed
    {
        $postvalue = (string)$postvalue;
        $postvalue = trim($postvalue);

        return $postvalue;
    }
}
