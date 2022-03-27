<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

class RepeatableForm extends \IWA_FormBuilder\Entity\Model\Abstract\Field
{
    protected ?\IWA_FormBuilder\Form\Form $subform = null;

    protected function setup(): void
    {
        $this->parseAttributeString('filter', 'subform');

        parent::setup();
    }

    public function renderInput(): string
    {
        $html = [];
        for ($i = 0; $i < 2; $i++) {
            $repeatablePrefix = 'item' . $i + 1;
            $this->subform?->setRepeatablePrefix($repeatablePrefix);

            $data = $this->getValue();
            $this->subform?->setData($data[$repeatablePrefix]);

            $html[] = $this->renderChildren();
        }

        return implode($html);
    }

    public static function xmlDeserialize(\IWA_FormBuilder\Entity\Service\Parse\Xml\Reader $reader): static
    {
        /** @psalm-suppress UnsafeInstantiation */
        $self = new static($reader);

        $form_old = $reader->getForm();

        $self->entityName = $reader->getEntityName();
        $self->attributes = $reader->getEntityAttributes();


        $subform = new \IWA_FormBuilder\Form\Form($form_old, \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBFORM);
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
