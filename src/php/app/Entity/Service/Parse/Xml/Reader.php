<?php

namespace IWA_FormBuilder\Entity\Service\Parse\Xml;

class Reader extends \IWA_FormBuilder\Override\SabreXml\Reader implements \IWA_FormBuilder\Entity\Service\Interface\ReaderInterface
{
    protected ?\IWA_FormBuilder\Form\Form $form = null;

    /*
     * ReaderInterface >>>
     */
    public function setForm(?\IWA_FormBuilder\Form\Form $form): void
    {
        $this->form = $form;
    }

    public function getForm(): ?\IWA_FormBuilder\Form\Form
    {
        return $this->form;
    }

    public function getEntityName(): string
    {
        return str_replace('{}', '', (string)$this->getClark());
    }

    public function getEntityAttributes(): array
    {
        return $this->parseAttributes();
    }

    public function getEntityChildren(): array
    {
        $result = [];

        $children_or_text = $this->parseInnerTree();
        if (is_array($children_or_text) and !empty($children_or_text)) {
            /** @var array $child */
            foreach ($children_or_text as $child) {
                if (($child['value'] instanceof \IWA_FormBuilder\Entity\Model\Abstract\Core)) {
                    $result[] = $child['value'];
                } else {
                    $result[] = $child;
                }
            }
        }

        return $result;
    }
    /*
     * <<< ReaderInterface
     */
}
