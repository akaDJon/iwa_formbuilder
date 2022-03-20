<?php

namespace IWA_FormBuilder\Form;

class FormInput
{
    public \IWA_FormBuilder\Form\Form $form;

    public function __construct(\IWA_FormBuilder\Form\Form $form)
    {
        $this->form = $form;
    }

    public function parseAndRender(string $format, mixed $source): string
    {
        $this->form->activateInputMode();

        $result = $this->form->parseAndRender($format, $source);

        $this->form->deactivateInputMode();

        return $result;
    }
}
