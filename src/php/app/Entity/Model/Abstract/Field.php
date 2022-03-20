<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

use IWA_FormBuilder\Tools\HtmlCollector;

abstract class Field extends Core
{
    protected string $entity = '';
    protected string $id = '';

    protected string $field_name = '';

    protected function setup(): void
    {
        $this->parseAttributeString('label', '', true);
        $this->parseAttributeString('description', '', true);
        $this->parseAttributeBoolean('field_hidden', false);

        $this->field_name = $this->getForm()->getPrefix() . '[' . $this->getAttributeString('name') . ']';

        parent::setup();
    }

    ////////////////////////////////////////////////////////////////////

    public function render(): string
    {
        if ($this->getForm()->isInputMode('input')) {
            return $this->renderWrapedInput();
        } else {
            return $this->renderField();
        }
    }

    abstract public function renderInput(): string;

    public function renderWrapedInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Core/FieldInput.twig', [
                'id'          => $this->id,
                'name'        => $this->getAttribute('name'),
                'input'       => $this->renderInput(),
                'entityname'  => $this->entity,
                'entityclass' => get_class($this),
            ]);
    }

    public function renderField(): string
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
                'id'              => $this->id,
                'name'            => $this->getAttribute('name'),
                'entityname'      => $this->entity,
                'entityclass'     => get_class($this),
                'labeltext'       => $this->getAttribute('label'),
                'inputs'          => $this->renderWrapedInput(),
                'descriptiontext' => $this->getAttribute('description'),
                'field_style'     => $field_style->render(),
                'label_style'     => $label_style->render(),
            ]);
    }
}
