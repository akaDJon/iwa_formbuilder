<?php

namespace IWA_FormBuilder\Form\Format;

use IWA_FormBuilder\Form;
use Sabre\Xml\Service;

class Xml extends Form
{
    public string $xml;

    public function __construct(string $xml)
    {
        $this->xml = $xml;
    }

    public function generate(): string
    {
        $service             = new Service();
        $service->elementMap = \IWA_FormBuilder\Map::get();

        $this->objecttree = $service->parse($this->xml);

        dump($this->objecttree);

        return '';
    }
}
