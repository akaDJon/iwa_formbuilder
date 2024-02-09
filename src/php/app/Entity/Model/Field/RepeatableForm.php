<?php

namespace IWA_FormBuilder\Entity\Model\Field;

class RepeatableForm extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected ?\IWA_FormBuilder\Form\Form $subform = null;

    protected function setup(): void
    {
        $this->parseAttributeString('data_filter', 'subform');

        parent::setup();
    }

    public function renderInput(): string
    {
        $html = [];
        for ($i = 0; $i < 2; $i++) {
            $repeatablePrefix = 'item' . $i + 1;

            $data = $this->getValue();

            $this->subform?->setRepeatablePrefix($repeatablePrefix);
            $this->subform?->setData($data[$repeatablePrefix] ?? []);
            $this->subform?->setEntityTree($this->children);
            $html[] = $this->subform?->render();
        }

        return implode($html);
    }

    public static function xmlDeserialize(\IWA_FormBuilder\Entity\Service\Parse\Xml\Reader $reader): static
    {
        /** @psalm-suppress UnsafeInstantiation */
        $self = new static($reader);

        $form_old = $reader->getForm();

        if (is_null($form_old)) {
            throw new \Exception('form is null');
        }

        $self->entityName = $reader->getEntityName();
        $self->attributes = $reader->getEntityAttributes();


        $options               = array();
        $options['parent']     = $form_old;

        $subform = new \IWA_FormBuilder\Form\Form($options);
        $subform->setPrefix($self->getAttributeString('name'));

        $self->subform = $subform;
        $reader->setForm($subform);

        $self->children = $reader->getEntityChildren();

        $reader->setForm($form_old);

        $self->setup();

        return $self;
    }

    public static function phpDeserialize(\IWA_FormBuilder\Entity\Service\Parse\PhpObject\Reader $reader): static
    {
        /** @psalm-suppress UnsafeInstantiation */
        $self = new static($reader);

        $self->entityName = $reader->getEntityName();
        $self->attributes = $reader->getEntityAttributes();
        $self->children   = $reader->getEntityChildren();

        $self->setup();

        return $self;
    }
}
