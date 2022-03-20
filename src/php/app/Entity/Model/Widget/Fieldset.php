<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

class Fieldset extends \IWA_FormBuilder\Entity\Model\Abstract\Widget
{
    public function render(): string
    {
        $html_children = $this->renderChildren();

        return '<fieldset>' . $html_children . '</fieldset>';
    }
}
