<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Hidden extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeBoolean('field_hidden', true);

        parent::setup();
    }

    protected function renderInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Hidden.twig', [
                'id'            => $this->getHtmlId(),
                'htmlInputName' => $this->getHtmlInputName(),
                'value'         => '',
            ]);
    }
}
