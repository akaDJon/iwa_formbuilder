<?php

namespace IWA_FormBuilder\Form;

/**
 * @property array<\IWA_FormBuilder\Entity\Model\Abstract\Core> $entitytree
 */
class Form
{
    protected string $prefix = 'iwaform';
    protected string $repeatablePrefix = '';
    protected array $data = [];
    protected array $control_name = [];
    protected string $renderMode;
    protected string $subformMode;
    protected string $needFormName = 'main';
    protected ?\IWA_FormBuilder\Form\Form $parent = null;
    protected array $entitytree = [];
    protected ?bool $needFormNameFound = null; // null - forms не найден. false - forms найден, но form нет, true - forms найден и form тоже

    protected int $last_generate = 0;
    protected bool $isSubmitted = false;
    protected array $validateResult = [];
    public int $dump = 0;

    /** @param array{parent?: \IWA_FormBuilder\Form\Form, renderMode?: string, subformMode? : string} $options */
    public function __construct(array $options = [])
    {
        $this->parent      = $options['parent'] ?? null;
        $this->renderMode  = $options['renderMode'] ?? \IWA_FormBuilder\Form\Enum\RenderMode::AS_SUBFORM;
        $this->subformMode = $options['subformMode'] ?? \IWA_FormBuilder\Form\Enum\SubformMode::INDEPENDENT;
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function setRepeatablePrefix(string $prefix): void
    {
        $this->repeatablePrefix = $prefix;
    }

    public function getFullHtmlId(): string
    {
        $repeatablePrefix = (!empty($this->repeatablePrefix) ? '__' . $this->repeatablePrefix : '');

        if (!is_null($this->parent)) {
            if ($this->subformMode == \IWA_FormBuilder\Form\Enum\SubformMode::EMBEDDED) {
                return $this->parent->getFullHtmlId() . $repeatablePrefix;
            }

            return $this->parent->getFullHtmlId() . '__' . $this->prefix . $repeatablePrefix;
        }

        return $this->prefix;
    }

    public function getFullHtmlName(): string
    {
        $repeatablePrefix = (!empty($this->repeatablePrefix) ? '[' . $this->repeatablePrefix . ']' : '');

        if (!is_null($this->parent)) {
            if ($this->subformMode == \IWA_FormBuilder\Form\Enum\SubformMode::EMBEDDED) {
                return $this->parent->getFullHtmlName() . $repeatablePrefix;
            }

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

    public function getData(): array
    {
        return $this->data;
    }

    public function generateName(): string
    {
        $this->last_generate++;

        return '__genid' . $this->last_generate;
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
        /** @var \IWA_FormBuilder\Form\Abstract\Parser $object */
        $object = \IWA_FormBuilder\Form\MapParser::getObject($format, [$this]);

        $entitytree = $object->run($source);

        // ошибка если не удалось найти запрошенную форму
        if ($this->needFormNameFound === false) {
            throw new \IWA_FormBuilder\Exception\FormEntityNotFoundException('Entity form "' . $this->getNeedFormName() . '" not found');
        }

        if (in_array($this->dump, [1])) {
            dumpn($entitytree, 'parse ' . $format . ': $entitytree "' . $entitytree->getEntityName() . '"');
        }

        return $entitytree;
    }

    /** @param \IWA_FormBuilder\Entity\Model\Abstract\Core|array<\IWA_FormBuilder\Entity\Model\Abstract\Core> $entityTree */
    public function setEntityTree(\IWA_FormBuilder\Entity\Model\Abstract\Core|array $entityTree): void
    {
        if (!is_array($entityTree)) {
            $entityTree = array($entityTree);
        }

        $this->entitytree = $entityTree;
    }

    public function parse(string $format, mixed $source): void
    {
        $this->setEntityTree($this->getParsedEntity($format, $source));
    }

    public function dataAssignTree(): void
    {
//        dumpn($this->prefix, 'prefix');
//        dumpn($this->repeatablePrefix, 'repeatablePrefix');
//        dumpn($this->data, '$this->data');

        $this->eachEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $entity) {
                $entity->dataAssign();
            }
        );
    }

    public function eachEntity(callable $fn): void
    {
        /** @var \IWA_FormBuilder\Entity\Model\Abstract\Core $entity */
        foreach ($this->entitytree as $entity) {
            $fn($entity);
        }
    }

    public function render(): string
    {
        $this->dataAssignTree();

        $html = [];
        $this->eachEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $entity) use (&$html) {
                $html[] = $entity->render();
            }
        );

//        if (in_array($this->dump, [2])) {
//            dumpn($entitytree, 'after render $entitytree "' . $entitytree->getEntityName() . '" after render');
//        }

        return implode($html);
    }

    public function parseAndRender(string $format, mixed $source): string
    {
        $this->parse($format, $source);
        $render = $this->render();

        return $render;
    }

    public function getRenderMode(): string
    {
        return $this->renderMode;
    }

//    public function setRenderMode(string $mode): void
//    {
//        $this->renderMode = $mode;
//    }

    public function setDataDatabase(array $data): void
    {
        $result = [];
        $this->eachEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $entity) use ($data, &$result) {
                $entity->dataDatabase2Post($data, $result);
            }
        );

//        dumpn($result, 'setDataDatabase $result');

        $this->data = $result;
    }

    public function getDataDatabase(): array
    {
        $result = [];
        $this->eachEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $entity) use (&$result) {
                $entity->dataPost2Database($result);
            }
        );

        return $result;
    }

    public function isSubmitted(): bool
    {
        return $this->isSubmitted;
    }

    public function handleRequest(?array $data = null): void
    {
        if (is_null($data)) {
            $data = $_POST[$this->getFullHtmlName()] ?? [];
        }

        if (isset($data['_iwa_submit_flag']) and $data['_iwa_submit_flag'] = 1) {
            $this->isSubmitted = true;
            $this->data        = $data;
        }
    }

    public function isValid(): bool
    {
        $this->dataAssignTree();

        $result = [];
        $this->eachEntity(
            function (\IWA_FormBuilder\Entity\Model\Abstract\Core $entity) use (&$result) {
                $entity->dataValidate($result);
            }
        );
        $this->validateResult = $result;

        dump($this->validateResult);

        return (empty($this->validateResult));
    }

    public function getValidateResult(): array
    {
        return $this->validateResult;
    }
}
