<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

use IWA_FormBuilder\Tools\HtmlCollector;

abstract class Field extends Core
{
    protected string $entityName = '';
    protected \IWA_FormBuilder\Form\Form $form;

    protected \IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface $reader;

    protected mixed $value = null;

    protected function setup(): void
    {
        $this->parseAttributeString('filter', 'safe');
        $this->parseAttributeString('label', '', true);
        $this->parseAttributeString('description', '', true);
        $this->parseAttributeBoolean('field_hidden', false);

        parent::setup();
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    protected function getHtmlInputName(): string
    {
        return $this->getForm()->getFullHtmlName() . '[' . $this->getAttributeString('name') . ']';
    }

    ////////////////////////////////////////////////////////////////////

    public function runFilter(mixed $value): mixed
    {
        $str_filter = $this->getAttributeString('filter');

        $arr_filter = explode('|', $str_filter);

        foreach ($arr_filter as $filtername) {
            $class = \IWA_FormBuilder\Entity\Service\MapFilter::getClass($filtername);

            /** @var \IWA_FormBuilder\Entity\Service\Filter\Interface\FilterInterface $filter */
            $filter = new $class();
            if (is_array($value) and !empty($value)) {
                /** @var mixed $val */
                foreach ($value as $key => $val) {
                    /** @psalm-suppress MixedAssignment */
                    $value[$key] = $filter->run($val);
                }
            } else {
                /** @var mixed $value */
                $value = $filter->run($value);
            }
        }

        return $value;
    }

    public function render(): string
    {
        if ($this->getForm()->getRenderMode() == \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBINPUT) {
            return $this->renderFieldOnlyInput();
        } else {
            return $this->renderFieldContainer();
        }
    }

    abstract protected function renderInput(): string;

    protected function renderInputProxy(): string
    {
        $this->getForm()->setDataToField($this);

        return $this->renderInput();
    }

    protected function renderFieldOnlyInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Core/FieldOnlyInput.twig', [
                'id'          => $this->getHtmlId(),
                'name'        => $this->getAttribute('name'),
                'input'       => $this->renderInputProxy(),
                'entityName'  => $this->entityName,
                'entityClass' => get_class($this),
            ]);
    }

    protected function renderFieldContainer(): string
    {
        $field_style = HtmlCollector::init(HtmlCollector::TYPE_STYLE);
        if ($this->getAttribute('field_hidden')) {
            $field_style->add('display: none');
        }

        $label_style = HtmlCollector::init(HtmlCollector::TYPE_STYLE);
        if (empty($this->getAttribute('label'))) {
            $label_style->add('display: none');
        }

        return \IWA_FormBuilder\App::getTwig()
            ->render('Core/FieldContainer.twig', [
                'id'              => $this->getHtmlId(),
                'name'            => $this->getAttribute('name'),
                'entityName'      => $this->entityName,
                'entityClass'     => get_class($this),
                'labeltext'       => $this->getAttribute('label'),
                'inputs'          => $this->renderFieldOnlyInput(),
                'descriptiontext' => $this->getAttribute('description'),
                'field_style'     => $field_style->render(),
                'label_style'     => $label_style->render(),
            ]);
    }
}
