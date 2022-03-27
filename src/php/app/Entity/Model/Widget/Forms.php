<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

class Forms extends \IWA_FormBuilder\Entity\Model\Abstract\Widget
{
    public function render(): string
    {
        return $this->renderChildren();
    }
}
