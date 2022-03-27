<?php

namespace IWA_FormBuilder\Entity\Service\Parse\PhpObject;

class Reader implements \IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface
{
    protected ?\IWA_FormBuilder\Form\Form $form = null;

    public array $elementMap = [];
    public ?\IWA_FormBuilder\Entity $currentEntity = null;

    public function parse(\IWA_FormBuilder\Entity $sourse): \IWA_FormBuilder\Entity\Model\Abstract\Core
    {
        $value = $this->parseCurrentElement($sourse);

        if ($value === false) {
            throw new \Exception('parse is null');
        }

        return $value;
    }

    public function getDeserializerForElementName(string $name): array
    {
        $map = $this->elementMap;

        if (!isset($map[$name])) {
            throw new \IWA_FormBuilder\Exception\FormMappingEntryNotFoundException('Mapping class for entity "' . $name . '" not found');
        }

        /** @var string $class */
        $class = $map[$name];

        if (!class_exists($class)) {
            throw new \IWA_FormBuilder\Exception\FormMappingClassNotFoundException('Mapping class "' . $class . '" for entity "' . $name . '" not exists');
        }

        return [$class, 'phpDeserialize'];
    }

    public function parseCurrentElement(\IWA_FormBuilder\Entity $entity): \IWA_FormBuilder\Entity\Model\Abstract\Core|false
    {
        $this->currentEntity = $entity;

        $formaction = $this->form?->parseCurrentElement($this);

        if ($formaction === false) {
            // возвращаем пустышку которую отказались парсить
            return false;
        }

        $name = $this->getEntityName();

        /**
         * @var \IWA_FormBuilder\Entity\Model\Abstract\Core $value
         */
        $value = call_user_func(
            $this->getDeserializerForElementName($name),
            $this
        );

        // после call_user_func нельзя обращатся к $this->currentEntity и методам его использующие. контекст меняется заходя вглубь

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
        return (string)$this->currentEntity?->entityName;
    }

    public function getEntityAttributes(): array
    {
        return (array)$this->currentEntity?->attributes;
    }

    public function getEntityAttribute(string $name): mixed
    {
        return $this->currentEntity?->attributes[$name] ?? null;
    }

    public function getEntityChildren(): array
    {
        $elements = [];

        $children = (array)$this->currentEntity?->children;

        /** @var object|false $child */
        foreach ($children as $child) {
            if (($child instanceof \IWA_FormBuilder\Entity)) {
                $elements[] = $this->parseCurrentElement($child);
            } else {
                $elements[] = $child;
            }
        }

        // убираем пустышки которые отказались парсить
        if (/*is_array($elements) and*/ !empty($elements)) {
            /** @var array $element */
            foreach ($elements as $key => $element) {
                if (empty($element)) {
                    unset($elements[$key]);
                }
            }
        }

        return $elements;
    }
    /*
     * <<< ReaderInterface
     */
}
