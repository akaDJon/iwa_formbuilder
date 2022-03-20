<?php

namespace IWA_FormBuilder\Form;

class Form
{
    protected string $prefix = 'jform';
    protected ?\IWA_FormBuilder\Entity\Model\Abstract\Core $entitytree = null;
    protected array $data = [];
    protected array $inputs = [];
    protected string $renderMode = 'normal';

    protected int $last_generate = 0;
    public bool $dump = false;

    public function __construct()
    {
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

//    public function setData(array $data): void
//    {
//        $this->data = $data;
//    }

    public function generateName(): string
    {
        $this->last_generate++;

        return '__genid' . $this->last_generate;
    }

    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function addInput(string $name, \IWA_FormBuilder\Entity\Model\Abstract\Field $input): void
    {
        $this->inputs[$name] = $input;
    }

    protected function getParsedEntity(string $format, mixed $source): \IWA_FormBuilder\Entity\Model\Abstract\Core
    {
        $map = \IWA_FormBuilder\Form\Map::get();
        if (!isset($map[$format])) {
            throw new \Exception('unsupported format');
        }

        /** @var string $class */
        $class = $map[$format];

        /** @var \IWA_FormBuilder\Form\Abstract\Parser $parser */
        $parser = new $class($this);

        $entitytree = $parser->run($source);

        if ($this->dump) {
            dumpn($entitytree, $format . ': $entitytree');
        }

        return $entitytree;
    }

    public function parse(string $format, mixed $source): void
    {
        $this->entitytree = $this->getParsedEntity($format, $source);
    }

    public function parseAndRender(string $format, mixed $source): string
    {
        return $this->getParsedEntity($format, $source)->render();
    }

    public function render(): string
    {
        if (empty($this->entitytree)) {
            return '';
        }

        return $this->entitytree->render();
    }

    public function isInputMode(string $mode): bool
    {
        return ($this->renderMode === $mode);
    }

    public function activateInputMode(): void
    {
        $this->renderMode = 'input';
    }

    public function deactivateInputMode(): void
    {
        $this->renderMode = 'normal';
    }

    public function getFormInput(): \IWA_FormBuilder\Form\FormInput
    {
        return new \IWA_FormBuilder\Form\FormInput($this);
    }
}
