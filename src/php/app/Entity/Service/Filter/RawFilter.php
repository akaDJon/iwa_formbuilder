<?php

namespace IWA_FormBuilder\Entity\Service\Filter;

class RawFilter implements \IWA_FormBuilder\Entity\Service\Filter\Interface\FilterInterface
{
    public function run(mixed $postvalue): mixed
    {
        return $postvalue;
    }
}
