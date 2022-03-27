<?php

namespace IWA_FormBuilder\Form;

class Form
{
    protected string $prefix = 'iwaform';
    protected string $repeatablePrefix = '';
    protected array $data = [];
    protected array $control_name = [];
    protected string $renderMode;
    protected string $needFormName = 'main';
    protected ?\IWA_FormBuilder\Form\Form $parent = null;
    protected ?bool $needFormNameFound = null; // null - forms не найден. false - forms найден, но form нет, true - forms найден и form тоже

    protected int $last_generate = 0;
    public int $dump = 0;

    public function __construct(?\IWA_FormBuilder\Form\Form $parent = null, string $renderMode = \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBFORM)
    {
        $this->parent     = $parent;
        $this->renderMode = $renderMode;
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function setRepeatablePrefix(string $prefix): void
    {
        $this->repeatablePrefix = $prefix;
    }

    public function getFullHtmlId(): string
    {
        $repeatablePrefix = (!empty($this->repeatablePrefix) ? '__' . $this->repeatablePrefix : '');

        if (!is_null($this->parent)) {
            return $this->parent->getFullHtmlId() . '__' . $this->prefix . $repeatablePrefix;
        }

        return $this->prefix;
    }

    public function getFullHtmlName(): string
    {
        $repeatablePrefix = (!empty($this->repeatablePrefix) ? '[' . $this->repeatablePrefix . ']' : '');

        if (!is_null($this->parent)) {
            return $this->parent->getFullHtmlName() . '[' . $this->prefix . ']' . $repeatablePrefix;
        }

        return $this->prefix;
    }

    public function setNeedFormName(string $value = 'main'): void
    {
        $this->needFormName = $value;
    }

    public function getNeedFormName(): string
    {
        return $this->needFormName;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function generateName(): string
    {
        $this->last_generate++;

        return '__genid' . $this->last_generate;
    }

    public function setDataToField(\IWA_FormBuilder\Entity\Model\Abstract\Field $field): void
    {
        $name = $field->getAttributeString('name');

        /** @var mixed $value */
        $value = $this->data[$name] ?? null;
        $field->setValue($field->runFilter($value));
    }

    public function parseCurrentElement(\IWA_FormBuilder\Entity\Service\Parse\Interface\ReaderInterface $reader): bool
    {
        $entity = $reader->getEntityName();
        $name   = (string)$reader->getEntityAttribute('name');

        // проверка одинаковых name у entity
        if ($entity !== 'form' and !empty($name)) {
            if (isset($this->control_name[$name])) {
                throw new \IWA_FormBuilder\Exception\FormControlNameException('Entity name "' . $name . '" has been used more than once');
            }

            $this->control_name[$name] = true;
        }

        if ($entity === 'forms') {
            $this->needFormNameFound = false;
        }

        if ($entity === 'form' and ($this->getNeedFormName() === $name)) {
            $this->needFormNameFound = true;
        }

        if ($entity === 'form' and ($this->getNeedFormName() !== $name)) {
            // отказались парсить
            return false;
        }

        return true;
    }

    protected function getParsedEntity(string $format, mixed $source): \IWA_FormBuilder\Entity\Model\Abstract\Core
    {
        $class = \IWA_FormBuilder\Form\MapParser::getClass($format);

        /** @var \IWA_FormBuilder\Form\Abstract\Parser $parser */
        $parser = new $class($this);

        $entitytree = $parser->run($source);

        // ошибка если не удалось найти запрошенную форму
        if ($this->needFormNameFound === false) {
            throw new \IWA_FormBuilder\Exception\FormEntityNotFoundException('Entity form "' . $this->getNeedFormName() . '" not found');
        }

        if (in_array($this->dump, [1])) {
            dumpn($entitytree, 'parse ' . $format . ': $entitytree "' . $entitytree->getEntityName() . '"');
        }

        return $entitytree;
    }

    public function parse(string $format, mixed $source): void
    {
        $this->getParsedEntity($format, $source);
    }

    public function parseAndRender(string $format, mixed $source): string
    {
        $entitytree = $this->getParsedEntity($format, $source);

        $render = $entitytree->render();

        if (in_array($this->dump, [2])) {
            dumpn($entitytree, 'after render $entitytree "' . $entitytree->getEntityName() . '" after render');
        }

        return $render;
    }

    public function getRenderMode(): string
    {
        return $this->renderMode;
    }

    public function setRenderMode(string $mode): void
    {
        $this->renderMode = $mode;
    }
}
