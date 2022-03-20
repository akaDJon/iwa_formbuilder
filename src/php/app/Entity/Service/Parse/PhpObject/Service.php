<?php

namespace IWA_FormBuilder\Entity\Service\Parse\PhpObject;

class Service
{
    public array $elementMap = [];

    protected ?\IWA_FormBuilder\Form\Form $form = null;

    public function parseSource(\IWA_FormBuilder\Form\Form $form, \IWA_FormBuilder\Entity $source): mixed
    {
        $this->form = $form;

        return $this->parse($source);
    }

    public function getReader(): \IWA_FormBuilder\Entity\Service\Parse\PhpObject\Reader
    {
        $r = new \IWA_FormBuilder\Entity\Service\Parse\PhpObject\Reader();

        $r->elementMap = $this->elementMap;

        $r->setForm($this->form);

        return $r;
    }

    public function parse(\IWA_FormBuilder\Entity $source): mixed
    {
        $r = $this->getReader();

        return $r->parse($source);
    }
}
