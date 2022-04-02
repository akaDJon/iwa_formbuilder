<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

class Form extends \IWA_FormBuilder\Entity\Model\Abstract\Widget
{
    protected function setup(): void
    {
        $this->parseAttributeBoolean('form_html', false);

        parent::setup();
    }

    public function render(): string
    {
        $html_children = $this->renderChildren();

        if ($this->getAttributeBoolean('form_html')) {
            return \IWA_FormBuilder\App::getTwig()
                ->render('Widget/Form.twig', [
                    'children' => $html_children,
                    'name'     => $this->getForm()->getFullHtmlName() . '[_iwa_submit_flag]',
                ]);
        } else {
            return $html_children;
        }
    }
}
