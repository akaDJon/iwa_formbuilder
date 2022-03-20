<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

class Join extends \IWA_FormBuilder\Entity\Model\Abstract\Widget
{
    public function render(): string
    {
        return $this->renderChildren();
    }
}
