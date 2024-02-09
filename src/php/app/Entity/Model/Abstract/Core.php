<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

abstract class Core implements \IWA_FormBuilder\Entity\Service\Parse\Interface\XmlDeserializable, \IWA_FormBuilder\Entity\Service\Parse\Interface\PhpDeserializable
{
    use CorePropertyTrait;
    use CoreAttributeTrait;

    protected string $entityName = '';

    protected \IWA_FormBuilder\Form\Form $form;
    protected \IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface $reader;

    protected array $children = [];

    ////////////////////////////////////////////////////////////////////

    protected function setup(): void
    {
        $this->parseAttributeString('name');
        $this->parseAttributeString('validate', 'none');

        $this->parsePropertyBoolean('id_is_reqired', true);
        $this->parsePropertyBoolean('name_is_generated', false);
        $this->parsePropertyString('data_converter_database', 'none');
    }

    protected function afterSetup(): void
    {
        if (!$this->issetAttribute('name')) {
            $this->setProperty('name_is_generated', true);
            $this->setAttribute('name', $this->getForm()->generateName());
        }
    }

    protected function getHtmlId(): string
    {
        if (($this->getPropertyBoolean('id_is_reqired') === false) and ($this->getPropertyBoolean('name_is_generated') === true)) {
            return '';
        }

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

    public function getEntityName(): string
    {
        return $this->entityName;
    }

//    public function getChildren(): array
//    {
//        return $this->children;
//    }

    public function eachChildrenEntity(callable $fn): void
    {
        $this->eachEntityRecursive($this->children, $fn);
        $this->eachEntityRecursive($this->attributes, $fn);
    }

    protected function eachEntityRecursive(array $arr, callable $fn): void
    {
        /**
         * @var \IWA_FormBuilder\Entity\Model\Abstract\Core|array|string $child
         */
        foreach ($arr as $child) {
            if ($child instanceof \IWA_FormBuilder\Entity\Model\Abstract\Core) {
                $fn($child);
            } else {
                if (is_array($child)) {
                    $this->eachEntityRecursive($child, $fn);
                }
            }
        }
    }

    ////////////////////////////////////////////////////////////////////

    abstract public function render(): string;

    protected function renderChildren(array $arr = null): string
    {
        if (!isset($arr)) {
            $arr = $this->children;
        }

        $html = [];

        $this->eachEntityRecursive(
            $arr,
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $child) use (&$html) {
                $html[] = $child->render();
            }
        );

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
        $self->afterSetup();

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
        $self->afterSetup();

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

    ////////////////////////////////////////////////////////////////////

    public function dataAssign(): void
    {
        $this->eachChildrenEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $child) {
                $child->dataAssign();
            }
        );
    }

    public function dataDatabase2Post(array $data, array &$result): void
    {
        $this->eachChildrenEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $child) use ($data, &$result) {
                $child->dataDatabase2Post($data, $result);
            }
        );
    }

    public function dataPost2Database(array &$result): void
    {
        $this->eachChildrenEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $child) use (&$result) {
                $child->dataPost2Database($result);
            }
        );
    }

    public function dataValidate(array &$result): void
    {
        $this->eachChildrenEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $child) use (&$result) {
                $child->dataValidate($result);
            }
        );
    }
}
