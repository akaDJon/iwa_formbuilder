<?php

namespace IWA_FormBuilder\Entity;

class FieldText extends Abstract\Core
{
    public string $name;
    public string $label;

    public function __construct()
    {
        $this->defaults();
    }

    protected function defaults(): void
    {
        $this->name  = '';
        $this->label = '';
    }

    public static function xmlDeserialize(\Sabre\Xml\Reader $reader): self
    {
        $self = new self();

        $attributes  = $reader->parseAttributes();
        $self->name  = (string)($attributes['name'] ?? rand());
        $self->label = (string)($attributes['label'] ?? $self->label);

        $reader->next();

        return $self;
    }

    public static function phpDeserialize(array $params): self
    {
        $self        = new self();
        $self->name  = (string)($params['name'] ?? rand());
        $self->label = (string)($params['label'] ?? '');

        return $self;
    }
}
