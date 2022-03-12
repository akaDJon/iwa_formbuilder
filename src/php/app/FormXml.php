<?php

namespace IWA_FormBuilder;

use Sabre\Xml\Service;

class FormXml extends Form
{
    public string $xmlfile;

    public function __construct(string $filepath)
    {
        $this->xmlfile = $filepath;
    }

    public function generate(): string
    {
        $service             = new Service();
        $service->elementMap = \IWA_FormBuilder\Map::get();

        $this->objecttree = $service->parse(file_get_contents($this->xmlfile));

        dump($this->objecttree);

        return '';
    }
}
