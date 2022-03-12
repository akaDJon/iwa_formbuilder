<?php

namespace IWA_FormBuilder\Entity;

class Form extends Abstract\Core
{
    public string $version;
    public array $children = [];

    public function __construct()
    {
        $this->defaults();
    }

    protected function defaults(): void
    {
        $this->version = '1';
    }

    public static function xmlDeserialize(\Sabre\Xml\Reader $reader): self
    {
        $self = new self();

        $attributes    = $reader->parseAttributes();
        $self->version = (string)($attributes['version'] ?? $self->version);

        $children_or_text = $reader->parseInnerTree();
        if (is_array($children_or_text) and !empty($children_or_text)) {
            /** @var array $child */
            foreach ($children_or_text as $child) {
                if (($child['value'] instanceof Abstract\Core)) {
                    $self->children[] = $child['value'];
                }
            }
        }

        $reader->next();

        return $self;
    }

    public static function phpDeserialize(array $params): self
    {
        $self = new self();

        $self->version = (string)($params['version'] ?? $self->version);

        if (!empty($params['children'])) {
            /** @var object $child */
            foreach ($params['children'] as $child) {
                if (($child instanceof \IWA_FormBuilder\Entity)) {
                    $self->children[] = $child->parse();
                }
            }
        }

        return $self;
    }
}
