<?php

namespace IWA_FormBuilder\Entity\Service\DataFilter;

class SafeFilter implements \IWA_FormBuilder\Entity\Service\DataFilter\Interface\FilterInterface
{
    public static function run(\IWA_FormBuilder\Entity\Model\Abstract\Field $entity, mixed $postvalue): mixed
    {
        $postvalue = (string)$postvalue;

        $postvalue = preg_replace('/[\xF0-\xF7].../s', "\xE2\xAF\x91", $postvalue);
        $postvalue = strip_tags($postvalue);

        return $postvalue;
    }
}
