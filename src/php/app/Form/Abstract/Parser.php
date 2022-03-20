<?php

namespace IWA_FormBuilder\Form\Abstract;

abstract class Parser
{
    public \IWA_FormBuilder\Form\Form $form;

    public function __construct(\IWA_FormBuilder\Form\Form $form)
    {
        $this->form = $form;
    }

    abstract public function run(mixed $source): \IWA_FormBuilder\Entity\Model\Abstract\Core;
}
