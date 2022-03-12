<?php

namespace IWA_FormBuilder\Entity;

use IWA_FormBuilder\Entity\Abstract;

class FieldList extends Abstract\Core
{
    public string $name;
    public string $label;
    public array $children = [];

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

        $classMap           = $reader->classMap;
        $classMap['option'] = FieldList_Option::class;

        $children_or_text = $reader->parseInnerTree($classMap);
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
        $self        = new self();
        $self->name  = (string)($params['name'] ?? rand());
        $self->label = (string)($params['label'] ?? $self->label);

        $classMap = [
            'option' => FieldList_Option::class,
        ];

        if (!empty($params['children'])) {
            /** @var object $child */
            foreach ($params['children'] as $child) {
                if (($child instanceof \IWA_FormBuilder\Entity)) {
                    $self->children[] = $child->parse($classMap);
                }
            }
        }

        return $self;
    }
}
