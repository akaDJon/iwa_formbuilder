<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

abstract class Core implements \IWA_FormBuilder\Entity\Service\Parse\Interface\XmlDeserializable, \IWA_FormBuilder\Entity\Service\Parse\Interface\PhpDeserializable
{
    protected string $entityName = '';
    protected \IWA_FormBuilder\Form\Form $form;

    protected \IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface $reader;

//    protected array $attributesParsed = [];

    protected array $attributes = [];
    protected array $children = [];

    ////////////////////////////////////////////////////////////////////

    protected function setup(): void
    {
        $this->parseAttributeString('name');

        if (empty($this->getAttribute('name'))) {
            $this->setAttribute('name', $this->getForm()->generateName());
        }
    }

    protected function getHtmlId(): string
    {
        return $this->getForm()->getFullHtmlId() . '__' . $this->getAttributeString('name');
    }

    ////////////////////////////////////////////////////////////////////

    public function __construct(\IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface $reader)
    {
        $this->reader = $reader;

        $form = $reader->getForm();

        if (is_null($form)) {
            throw new \Exception('form is null');
        }

        $this->form = $form;
    }

    public function getForm(): \IWA_FormBuilder\Form\Form
    {
        return $this->form;
    }

    public function getReader(): \IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface
    {
        return $this->reader;
    }

    ////////////////////////////////////////////////////////////////////

    protected function issetAttribute(string $name): bool
    {
        return isset($this->attributes[$name]);
    }

    protected function getAttribute(string $name): mixed
    {
        if (!isset($this->attributes[$name])) {
            throw new \Exception('Attribute "' . $name . '" not setup');
        }

        return $this->attributes[$name];
    }

    public function getAttributeString(string $name): string
    {
        return (string)$this->getAttribute($name);
    }

    public function getAttributeBoolean(string $name): bool
    {
        return (bool)$this->getAttribute($name);
    }

    protected function setAttribute(string $name, mixed $value): void
    {
        $this->attributes[$name] = $value;
    }

    protected function getAttributes(): mixed
    {
        return $this->attributes;
    }

    protected function setAttributes(array $data): void
    {
        $this->attributes = $data;
    }

    public function getEntityName(): string
    {
        return $this->entityName;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    protected function markAttributeParsed(string $name): void
    {
//        $this->attributesParsed[$name] = true;
    }

    protected function parseAttributeInteger(string $name, int $default = 0): bool
    {
        $this->markAttributeParsed($name);

        if (!$this->issetAttribute($name) or $this->getAttribute($name) === '0' or $this->getAttribute($name) === 0) {
            $this->setAttribute($name, $default);

            return false;
        }

        $this->setAttribute($name, (int)$this->getAttribute($name));

        return true;
    }

    protected function parseAttributeBoolean(string $name, null|bool $default = null): bool
    {
        $this->markAttributeParsed($name);

        if (!$this->issetAttribute($name)) {
            $this->setAttribute($name, $default);

            return false;
        }

        if ($default === null) {
            return false;
        }

        if ($default === false) {
            $this->setAttribute($name, ($this->getAttribute($name) === true or $this->getAttribute($name) === 'true'));
        }

        if ($default === true) {
            $this->setAttribute($name, !($this->getAttribute($name) === false or $this->getAttribute($name) === 'false'));
        }

        $this->setAttribute($name, (bool)$this->getAttribute($name));

        return true;
    }

    protected function parseAttributeString(string $name, string $default = '', bool $lang_parse = false): bool
    {
        $this->markAttributeParsed($name);

        if (!$this->issetAttribute($name) or $this->getAttribute($name) === '') {
            $this->setAttribute($name, $default);

            return false;
        }

        if ($lang_parse) {
            // TODO
        }

        $this->setAttribute($name, $this->getAttributeString($name));

        return true;
    }

    protected function parseAttributeStringEnhanced(string $name, string $default = '', bool $lang_parse = false, string $prefix = '', string $postfix = ''): bool
    {
        $result = $this->parseAttributeString($name, $default, $lang_parse);

        if ($result) {
            $this->setAttribute($name, $prefix . ($this->getAttributeString($name)) . $postfix);
        }

        return $result;
    }

    ////////////////////////////////////////////////////////////////////

    abstract public function render(): string;

    protected function renderChildren(): string
    {
        $html = [];
        /**
         * @var \IWA_FormBuilder\Entity\Model\Abstract\Core|array $child
         */
        foreach ($this->children as $child) {
            if ($child instanceof \IWA_FormBuilder\Entity\Model\Abstract\Core) {
                $html[] = $child->render();
            }
        }

        return implode($html);
    }

    ////////////////////////////////////////////////////////////////////

    public static function xmlDeserialize(\IWA_FormBuilder\Entity\Service\Parse\Xml\Reader $reader): static
    {
        /** @psalm-suppress UnsafeInstantiation */
        $self = new static($reader);

        $self->entityName = $reader->getEntityName();
        $self->attributes = $reader->getEntityAttributes();
        $self->children   = $reader->getEntityChildren();

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

    protected function xmlChildrenToAttributes(array $options): void
    {
        /**
         * @var array<string, array>                                $options
         * @var array{xmltag: string, fnSetChildProperty: callable} $option
         */
        foreach ($options as $property => $option) {
            $xmltag             = $option['xmltag'];
            $fnSetChildProperty = $option['fnSetChildProperty'];
            if (!empty($this->children)) {
                $array = [];
                /**
                 * @var array{name: string} $child
                 */
                foreach ($this->children as $child) {
                    if (($child['name'] == '{}' . $xmltag)) {
                        /**
                         * @psalm-suppress MixedArrayAssignment
                         * @psalm-suppress MixedAssignment
                         */
                        $array[] = $fnSetChildProperty($child);
                    }
                }

                $this->setAttribute($property, $array);
            }
        }
        $this->children = [];
    }

//    protected function getCurrentFolder(): string
//    {
//        $helloReflection = new \ReflectionClass($this);
//
//        return $helloReflection->getFilename();
//    }
}
