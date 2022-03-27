<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class Text extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected function setup(): void
    {
        $this->parseAttributeString('filter', 'safe|trim');

        parent::setup();
    }

    protected function renderInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Field/Text.twig', [
                'id'            => $this->getHtmlId(),
                'htmlInputName' => $this->getHtmlInputName(),
                'value'         => $this->getValue(),
            ]);
    }
}
