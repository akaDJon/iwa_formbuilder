<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

use IWA_FormBuilder\Tools\HtmlCollector;

abstract class Field extends Core
{
    protected string $entityName = '';

    protected \IWA_FormBuilder\Form\Form $form;
    protected \IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface $reader;

    protected mixed $value = null;
    protected array $validateResult = [];
    protected ?\IWA_FormBuilder\Entity\Service\DataType\Abstract\CoreType $dataType = null;

    protected function setup(): void
    {
        $this->parseAttributeString('dataFilter', 'safe');
        $this->parseAttributeString('label', '', true);
        $this->parseAttributeString('description', '', true);
        $this->parseAttributeBoolean('field_hidden', false);
        $this->parseAttributeBoolean('required', false);
        $this->parseAttributeBoolean('readonly', false);
        $this->parseAttributeBoolean('disabled', false);

        parent::setup();
    }

    protected function afterSetup(): void
    {
        if (empty($this->getAttributeString('label'))) {
            $this->setAttribute('label', $this->getAttributeString('name'));
        }

        if ($this->issetProperty('dataType')) {
            $dataType = $this->getPropertyString('dataType');
            /** @var \IWA_FormBuilder\Entity\Service\DataType\Abstract\CoreType $object */
            $object = \IWA_FormBuilder\Entity\Service\MapDataType::getObject($dataType);

            $this->dataType = $object;
        }

        if ($this->getAttributeBoolean('required')) {
            $validate = $this->getAttributeString('validate');
            if (!empty($validate)) {
                $this->setAttribute('validate', 'require' . '|' . $validate);
            } else {
                $this->setAttribute('validate', 'require');
            }
        }

        parent::afterSetup();
    }

    protected function renderFieldOnlyInput(): string
    {
        return \IWA_FormBuilder\App::getTwig()
            ->render('Core/FieldOnlyInput.twig', [
                'id'          => $this->getHtmlId(),
                'name'        => $this->getAttributeString('name'),
                'input'       => $this->renderInputProxy(),
                'entityName'  => $this->entityName,
                'entityClass' => get_class($this),
            ]);
    }

    protected function renderFieldContainer(): string
    {
        $field_style = HtmlCollector::initStyle();
        if ($this->getAttributeBoolean('field_hidden')) {
            $field_style->add('display: none');
        }

        $label_style = HtmlCollector::initStyle();


        return \IWA_FormBuilder\App::getTwig()
            ->render('Core/FieldContainer.twig', [
                'id'          => $this->getHtmlId(),
                'name'        => $this->getAttributeString('name'),
                'entityName'  => $this->entityName,
                'entityClass' => get_class($this),
                'labeltext'   => $this->getAttributeString('label'),
                'inputs'      => $this->renderFieldOnlyInput(),
                'description' => $this->getAttributeString('description'),
                'validate'    => $this->printValidateResult(),
                'required'    => $this->getAttributeBoolean('required'),
                'readonly'    => $this->getAttributeBoolean('readonly'),
                'disabled'    => $this->getAttributeBoolean('disabled'),
                'field_style' => $field_style->render(),
                'label_style' => $label_style->render(),
            ]);
    }


    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    protected function getHtmlInputName(): string
    {
        return $this->getForm()->getFullHtmlName() . '[' . $this->getAttributeString('name') . ']';
    }

    public function getDataType(): ?\IWA_FormBuilder\Entity\Service\DataType\Abstract\CoreType
    {
        return $this->dataType;
    }

    ////////////////////////////////////////////////////////////////////

    public function runFilter(mixed $value): mixed
    {
        $filter = $this->getAttributeString('dataFilter');
        $rules  = \IWA_FormBuilder\Tools\FriendlyStringParser::parse($filter);

        foreach ($rules as $rule) {
            /** @var \IWA_FormBuilder\Entity\Service\DataFilter\Interface\FilterInterface $object */
            $object = \IWA_FormBuilder\Entity\Service\MapDataFilter::getObject($rule['name']);

            if (is_array($value) and !empty($value)) {
                /** @var mixed $val */
                foreach ($value as $key => $val) {
                    /** @psalm-suppress MixedAssignment */
                    $value[$key] = $object::run($this, $val);
                }
            } else {
                /** @var mixed $value */
                $value = $object::run($this, $value);
            }
        }

        return $value;
    }

    public function render(): string
    {
        if ($this->getForm()->getRenderMode() == \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBINPUT) {
            return $this->renderFieldOnlyInput();
        } else {
            return $this->renderFieldContainer();
        }
    }

    abstract protected function renderInput(): string;

    protected function renderInputProxy(): string
    {
        return $this->renderInput();
    }


    public function dataAssign(): void
    {
        $name = $this->getAttributeString('name');
        $form = $this->getForm();
        $data = $form->getData();

        /** @var mixed $value */
        $value = $data[$name] ?? null;
        $this->setValue($this->runFilter($value));

        parent::dataAssign();
    }

    public function dataDatabase2Post(array $data, array &$result): void
    {
        $name = $this->getAttributeString('name');

        $mapname = $this->getPropertyString('dataConverterDatabase');
        /** @var \IWA_FormBuilder\Entity\Service\DataConverterDatabase\Interface\DataConverterDatabaseInterface $object */
        $object = \IWA_FormBuilder\Entity\Service\MapDataConverterDatabase::getObject($mapname);

        if (isset($data[$name])) {
            $result[$name] = $object::convertDatabase2Post($this, $data[$name]);
        }

        parent::dataDatabase2Post($data, $result);
    }

    public function setValidateResult(array $array): void
    {
        $this->validateResult = $array;
    }

    public function printValidateResult(): array
    {
        return $this->validateResult;
    }

    public function dataValidate(array &$result): void
    {
        $name = $this->getAttributeString('name');

        $validate = $this->getAttributeString('validate');
        $rules    = \IWA_FormBuilder\Tools\FriendlyStringParser::parse($validate);

        foreach ($rules as $rule) {
            /** @var \IWA_FormBuilder\Entity\Service\DataValidator\Interface\DataValidatorInterface $object */
            $object = \IWA_FormBuilder\Entity\Service\MapDataValidator::getObject($rule['name']);

            $valid = $object::check($this, $this->getValue(), $rule['params']);
            if ($valid !== true) {
                $result[$name][] = $valid;
            }
        }

        if (isset($result[$name])) {
            $this->setValidateResult($result[$name]);
        }

        parent::dataValidate($result);
    }
}
