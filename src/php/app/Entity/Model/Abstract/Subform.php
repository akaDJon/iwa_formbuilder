<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

abstract class Subform extends Field
{
    protected ?\IWA_FormBuilder\Form\Form $subform = null;

    public const SUBFORM_TYPE_INDEPENDENT = 'independent';
    public const SUBFORM_TYPE_EMBEDDED    = 'embedded';

    protected function setup(): void
    {
        $this->parseAttributeString('data_filter', 'subform');
        $this->parseAttributeString('subform_type', self::SUBFORM_TYPE_INDEPENDENT);

        switch ($this->getAttributeString('subform_type')) {
            case self::SUBFORM_TYPE_EMBEDDED:
                $subformMode = \IWA_FormBuilder\Form\Enum\SubformMode::EMBEDDED;
                break;

            case self::SUBFORM_TYPE_INDEPENDENT:
            default:
                $subformMode = \IWA_FormBuilder\Form\Enum\SubformMode::INDEPENDENT;
                break;
        }

        $options                = array();
        $options['parent']      = $this->getForm();
        $options['subformMode'] = $subformMode;
        $this->subform          = new \IWA_FormBuilder\Form\Form($options);

        switch ($this->getAttributeString('subform_type')) {
            case self::SUBFORM_TYPE_EMBEDDED:
                break;

            case self::SUBFORM_TYPE_INDEPENDENT:
            default:
                $this->subform->setPrefix($this->getAttributeString('name'));
                break;
        }

        $this->subformParse();

        parent::setup();
    }

    abstract protected function subformParse(): void;

    public function dataAssign(): void
    {
        if (!isset($this->subform)) {
            throw new \Exception('subform is null');
        }

        parent::dataAssign();

        switch ($this->getAttributeString('subform_type')) {
            case self::SUBFORM_TYPE_EMBEDDED:
                $data = $this->getForm()->getData();
                break;

            case self::SUBFORM_TYPE_INDEPENDENT:
            default:
                $data = (array)$this->getValue();
                break;
        }

        $this->subform->setData($data);
    }

    protected function renderInput(): string
    {
        if (!isset($this->subform)) {
            throw new \Exception('subform is null');
        }

        return $this->subform->render();
    }

    public function dataValidate(array &$result): void
    {
        if (!isset($this->subform)) {
            throw new \Exception('subform is null');
        }

        $name = $this->getAttributeString('name');

        $this->subform->isValid();

        $validateResult = $this->subform->getValidateResult();

        if (!empty($validateResult)) {
            $result[$name] = $validateResult;
        }
    }

    public function dataDatabase2Post(array $data, array &$result): void
    {
        if (!isset($this->subform)) {
            throw new \Exception('subform is null');
        }

        switch ($this->getAttributeString('subform_type')) {
            case self::SUBFORM_TYPE_EMBEDDED:
                $this->subform->setDataDatabase($data);
                $result = array_merge($result, $this->subform->getData());
                break;

            case self::SUBFORM_TYPE_INDEPENDENT:
            default:
                $name = $this->getAttributeString('name');
                if (!isset($data[$name])) {
                    $subarr = [];

                    foreach ($data as $key => $row) {
                        $nameprefix = $name . '__';
                        if (str_starts_with($key, $nameprefix)) {
                            $subkey          = substr($key, (strlen($nameprefix)));
                            $subarr[$subkey] = $row;
                        }
                    }

                    if (!empty($subarr)) {
                        $this->subform->setDataDatabase($subarr);
                        $result[$name] = $this->subform->getData();
                    }
                }
                break;
        }

        parent::dataDatabase2Post($data, $result);
    }
}
