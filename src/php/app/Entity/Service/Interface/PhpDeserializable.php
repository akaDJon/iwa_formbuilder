<?php

namespace IWA_FormBuilder\Entity\Service\Interface;

interface PhpDeserializable
{
    public static function phpDeserialize(\IWA_FormBuilder\Entity\Service\Parse\PhpObject\Reader $reader): static;
}
