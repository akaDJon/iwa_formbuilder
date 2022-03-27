<?php

namespace IWA_FormBuilder\Entity\Service\Filter;

class SafeFilter implements \IWA_FormBuilder\Entity\Service\Filter\Interface\FilterInterface
{
    public function run(mixed $postvalue): mixed
    {
        $postvalue = (string)$postvalue;

        $postvalue = preg_replace('/[\xF0-\xF7].../s', "\xE2\xAF\x91", $postvalue);
        $postvalue = strip_tags($postvalue);

        return $postvalue;
    }
}
