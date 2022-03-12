<?php

namespace IWA_FormBuilder\Entity;

// phpcs:disable Squiz.Classes.ValidClassName.NotCamelCaps
class FieldList_Option extends Abstract\Core
{
    public string $value;
    public string $text;

    public function __construct()
    {
        $this->defaults();
    }

    protected function defaults(): void
    {
        $this->value = '';
        $this->text  = '';
    }

    public static function xmlDeserialize(\Sabre\Xml\Reader $reader): self
    {
        $self = new self();

        $attributes  = $reader->parseAttributes();
        $self->value = (string)($attributes['value']);

        $self->text = $reader->readText();

        $reader->next();

        return $self;
    }

    public static function phpDeserialize(array $params): self
    {
        $self        = new self();
        $self->value = (string)($params['value']);
        $self->text  = (string)($params['text']);

        return $self;
    }
}
