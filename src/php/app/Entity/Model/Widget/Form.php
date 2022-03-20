<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

class Form extends \IWA_FormBuilder\Entity\Model\Abstract\Widget
{
    protected function setup(): void
    {
        $this->parseAttributeString('version', '1');

        parent::setup();
    }

    public function render(): string
    {
        $html_children = $this->renderChildren();

        return '<form method="post">' . $html_children . '</form>';
    }
}
