<?php

namespace IWA_FormBuilder\Entity\Model\Abstract;

abstract class Subform extends Field
{
    protected ?\IWA_FormBuilder\Form\Form $subform = null;

    protected function setup(): void
    {
        $this->parseAttributeString('dataFilter', 'subform');
        $this->parseAttributeString('subform_type', 'independent'); // embedded // independent

        $this->subform = $this->subform();

        parent::setup();
    }

    abstract protected function subform(): \IWA_FormBuilder\Form\Form;

    public function dataAssign(): void
    {
        if (!isset($this->subform)) {
            throw new \Exception('subform is null');
        }

        parent::dataAssign();

        $data = (array)$this->getValue();

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

        $result[$name] = $this->subform->getValidateResult();
    }

    public function dataDatabase2Post(array $data, array &$result): void
    {
        if (!isset($this->subform)) {
            throw new \Exception('subform is null');
        }

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

        parent::dataDatabase2Post($data, $result);
    }
}
