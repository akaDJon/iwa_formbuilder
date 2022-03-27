<?php

namespace IWA_FormBuilder\Entity\Service\Filter;

class UnsetFilter implements \IWA_FormBuilder\Entity\Service\Filter\Interface\FilterInterface
{
    public function run(mixed $postvalue): mixed
    {
        return false;
    }
}
