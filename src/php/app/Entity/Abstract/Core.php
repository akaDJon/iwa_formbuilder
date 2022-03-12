<?php

namespace IWA_FormBuilder\Entity\Abstract;

abstract class Core implements \Sabre\Xml\XmlDeserializable
{
    abstract public static function xmlDeserialize(\Sabre\Xml\Reader $reader): self;

    abstract public static function phpDeserialize(array $params): self;
}
