<?php

namespace IWA_FormBuilder\Entity\Model\Widget;

use IWA_FormBuilder\Tools\HtmlCollector;

class Columns extends \IWA_FormBuilder\Entity\Model\Abstract\Widget
{
    protected function setup(): void
    {
        $this->parseAttributeString('class', '');

        $this->parsePropertyBoolean('id_is_reqired', false);

        parent::setup();
    }

    public function render(): string
    {
        $items = [];

        // $item = ['class' => '', 'children' => ''];
        /**
         * @var array{class: string, children: array} $item
         */
        foreach ($this->getAttributeArray('items') as $item) {
            $item_class = HtmlCollector::initClass('col')->add($item['class']);

            $items[] = [
                'class'    => $item_class->value(),
                'children' => $this->renderChildren($item['children']),
            ];
        }

        $columns_class = HtmlCollector::initClass('row')->add($this->getAttributeString('class'));

        return \IWA_FormBuilder\App::getTwig()
            ->render('Widget/Columns.twig', [
                'id'    => $this->getHtmlId(),
                'class' => $columns_class->value(),
                'items' => $items,
            ]);
    }

    /** @psalm-suppress MoreSpecificReturnType */
    public static function xmlDeserialize(\IWA_FormBuilder\Entity\Service\Parse\Xml\Reader $reader): static
    {
        $self = parent::xmlDeserialize($reader);

        $self->xmlChildrenToAttributes([
            'items' => [
                'xmltag'             => 'item',
                'fnSetChildProperty' => function (array $child) {
                    return [
                        'class'    => $child['attributes']['class'] ?? '',
                        'children' => $child['value'] ?? [],
                    ];
                },
            ],
        ]);

        /** @psalm-suppress LessSpecificReturnStatement */
        return $self;
    }
}
