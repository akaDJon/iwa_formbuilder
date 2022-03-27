<?php

namespace IWA_FormBuilder\Entity\Service\Filter\Interface;

interface FilterInterface
{
    public function run(mixed $postvalue): mixed;
}
