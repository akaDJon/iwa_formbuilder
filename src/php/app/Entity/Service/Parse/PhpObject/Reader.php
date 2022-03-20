<?php

namespace IWA_FormBuilder\Entity\Service\Parse\PhpObject;

class Reader implements \IWA_FormBuilder\Entity\Service\Interface\ReaderInterface
{
    protected ?\IWA_FormBuilder\Form\Form $form = null;

    public array $elementMap = [];
    public ?\IWA_FormBuilder\Entity $currentEntity = null;

    public function parse(\IWA_FormBuilder\Entity $sourse): \IWA_FormBuilder\Entity\Model\Abstract\Core
    {
        return $this->parseCurrentElement($sourse);
    }

    public function getDeserializerForElementName(string $name): array
    {
        $map = $this->elementMap;

        /** @var string $class */
        $class = $map[$name];

        return [$class, 'phpDeserialize'];
    }

    public function parseCurrentElement(\IWA_FormBuilder\Entity $entity): \IWA_FormBuilder\Entity\Model\Abstract\Core
    {
        $this->currentEntity = $entity;

        $name = $this->getEntityName();

        /**
         * @var \IWA_FormBuilder\Entity\Model\Abstract\Core $value
         */
        $value = call_user_func(
            $this->getDeserializerForElementName($name),
            $this
        );

        $this->currentEntity = null;

        return $value;
    }

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
        return (string)$this->currentEntity?->entityname;
    }

    public function getEntityAttributes(): array
    {
        return (array)$this->currentEntity?->attributes;
    }

    public function getEntityChildren(): array
    {
        $result = [];

        $children = (array)$this->currentEntity?->children;

        /** @var object $child */
        foreach ($children as $child) {
            if (($child instanceof \IWA_FormBuilder\Entity)) {
                $result[] = $this->parseCurrentElement($child);
            } else {
                $result[] = $child;
            }
        }

        return $result;
    }
    /*
     * <<< ReaderInterface
     */
}
