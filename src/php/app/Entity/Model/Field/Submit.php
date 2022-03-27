<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Submit extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeString('button_value', 'true');
        $this->parseAttributeString('button_text', $this->getAttributeString('name'));

        parent::setup();
    }

    protected function renderInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Submit.twig', [
                'id'            => $this->getHtmlId(),
                'htmlInputName' => $this->getHtmlInputName(),
                'button_value'  => $this->getAttribute('button_value'),
                'button_text'   => $this->getAttribute('button_text'),
            ]);
    }
}
