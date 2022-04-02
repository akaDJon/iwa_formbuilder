<?php

namespace IWA_FormBuilder\Tools;

/** @property string[] $values */
class HtmlCollector
{
    public const TYPE_CLASS = 'class';
    public const TYPE_STYLE = 'style';
    public const TYPE_ATTR  = 'attr';

    protected array $values = [];
    protected string $type;
    protected string $glue;
    protected string $tag;

    public function __construct(string $type)
    {
        $this->type = $type;

        $glues      = [
            self::TYPE_CLASS => ' ',
            self::TYPE_STYLE => '; ',
            self::TYPE_ATTR  => ' ',
        ];
        $this->glue = $glues[$type];

        $tags      = [
            self::TYPE_CLASS => 'class',
            self::TYPE_STYLE => 'style',
            self::TYPE_ATTR  => '',
        ];
        $this->tag = $tags[$type];
    }

    protected static function init(string $type, string $values = ''): self
    {
        $self = new self($type);

        if ($values) {
            $self->values = explode($self->glue, $values);
        }

        return $self;
    }

    public static function initClass(string $values = ''): self
    {
        return static::init(HtmlCollector::TYPE_CLASS, $values);
    }

    public static function initStyle(string $values = ''): self
    {
        return static::init(HtmlCollector::TYPE_STYLE, $values);
    }

    public static function initAttr(string $values = ''): self
    {
        return static::init(HtmlCollector::TYPE_ATTR, $values);
    }

    public function add(string $value, string $default = ''): static
    {
        $value   = trim($value);
        $default = trim($default);

        if ($value === '') {
            $value = $default;
        }

        if (!empty($value)) {
            if (!in_array($value, $this->values)) {
                $this->values[] = $value;
            }
        }

        return $this;
    }

    public function addEnhanced(string $value, string $default = '', string $prefix = '', string $postfix = ''): static
    {
        $value   = trim($value);
        $default = trim($default);

        if ($value === '') {
            $value = $default;
        }

        if (!empty($value)) {
            if (!in_array($prefix . $value . $postfix, $this->values)) {
                $this->values[] = $prefix . $value . $postfix;
            }
        }

        return $this;
    }

    public function render(): string
    {
        $value = $this->value();

        if (empty($value)) {
            return '';
        }

        if (empty($this->tag)) {
            return $value;
        }

        return $this->tag . '="' . $value . '"';
    }

    public function value(): string
    {
        if (empty($this->values)) {
            return '';
        }

        return implode($this->glue, $this->values);
    }
}
