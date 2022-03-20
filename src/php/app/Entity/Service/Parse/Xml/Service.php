<?php

namespace IWA_FormBuilder\Entity\Service\Parse\Xml;

class Service extends \IWA_FormBuilder\Override\SabreXml\Service
{
    protected ?\IWA_FormBuilder\Form\Form $form = null;

    public function parseSource(\IWA_FormBuilder\Form\Form $form, string $source): mixed
    {
        $this->form = $form;

        return $this->parse($source);
    }

    public function getReader(): \IWA_FormBuilder\Entity\Service\Parse\Xml\Reader
    {
        $r = new \IWA_FormBuilder\Entity\Service\Parse\Xml\Reader();

        $r->elementMap = $this->elementMap;

        $r->setForm($this->form);

        return $r;
    }
}
