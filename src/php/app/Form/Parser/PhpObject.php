<?php

namespace IWA_FormBuilder\Form\Parser;

class PhpObject extends \IWA_FormBuilder\Form\Abstract\Parser
{
    protected function prepareSource(mixed $source): \IWA_FormBuilder\Entity
    {
        if (!$source instanceof \IWA_FormBuilder\Entity) {
            throw new \Exception('$source is not instanceof \IWA_FormBuilder\Entity');
        }

        return $source;
    }

    public function run(mixed $source): \IWA_FormBuilder\Entity\Model\Abstract\Core
    {
        $source = $this->prepareSource($source);

        $service             = new \IWA_FormBuilder\Entity\Service\Parse\PhpObject\Service();
        $service->elementMap = \IWA_FormBuilder\Entity\Service\MapModel::getItems();

        $entitytree = $service->parseSource($this->form, $source);

        if (!$entitytree instanceof \IWA_FormBuilder\Entity\Model\Abstract\Core) {
            throw new \Exception('$entitytree is not \IWA_FormBuilder\Entity\Model\Abstract\Core');
        }

        return $entitytree;
    }
}
