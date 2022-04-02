<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

class Div extends \IWA_FormBuilder\Entity\Model\Abstract\Widget
{
    protected function setup(): void
    {
        $this->setProperty('idIsReqired', false);
        $this->parseAttributeString('class');

        parent::setup();
    }

    public function render(): string
    {
        $html_children = $this->renderChildren();

        return \IWA_FormBuilder\App::getTwig()
            ->render('Widget/Div.twig', [
                'id'       => $this->getHtmlId(),
                'class'    => $this->getAttributeString('class'),
                'children' => $html_children,
            ]);
    }
}
