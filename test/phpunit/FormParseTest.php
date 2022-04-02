<?php

use PHPUnit\Framework\TestCase;

class FormParseTest extends TestCase
{
    /** два поля имеют одинаковые имена */
    public function testFormControlNameExceptionFail01()
    {
        $this->expectException(\IWA_FormBuilder\Exception\FormControlNameException::class);

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_text',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_text',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 2',
                        ]),
                    ],
                ]),
            ],
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** одинаковых имен нет */
    public function testFormControlNameExceptionOk01()
    {
        $this->expectNotToPerformAssertions();

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_text',
                            'name'   => 'main',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** точка входа form{name=main} не найдена */
    public function testFormEntityNotFoundExceptionFail01()
    {
        $this->expectException(\IWA_FormBuilder\Exception\FormEntityNotFoundException::class);

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main1',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_text',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** точка входа form{name=mainXXX} не найдена */
    public function testFormEntityNotFoundExceptionFail02()
    {
        $this->expectException(\IWA_FormBuilder\Exception\FormEntityNotFoundException::class);

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'mainYYY',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_text',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->setNeedFormName('mainXXX');
        $form->parse('object', $source);
    }

    /** точка входа form{name=mainXXX} найдена */
    public function testFormEntityNotFoundExceptionOk01()
    {
        $this->expectNotToPerformAssertions();

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'mainXXX',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_text',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->setNeedFormName('mainXXX');
        $form->parse('object', $source);
    }

    /** сущность field_textXXX не найдена */
    public function testFormMappingEntryNotFoundExceptionFail01()
    {
        $this->expectException(\IWA_FormBuilder\Exception\FormMappingEntryNotFoundException::class);

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_textXXX',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** класс сущности field_textXXX не найден */
    public function testFormMappingClassNotFoundExceptionFail01()
    {
        $this->expectException(\IWA_FormBuilder\Exception\FormMappingClassNotFoundException::class);

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_textXXX',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        \IWA_FormBuilder\Entity\Service\MapModel::addItem('field_textXXX', \IWA_FormBuilder\Entity\Model\Field\TextXXX::class);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** класс сущности field_textXXX найден (объявлен ::class) */
    public function testFormMappingClassNotFoundExceptionOk01()
    {
        $this->expectNotToPerformAssertions();

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_textXXX',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        \IWA_FormBuilder\Entity\Service\MapModel::addItem('field_textXXX', \IWA_FormBuilder\Entity\Model\Field\Text::class);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** класс сущности field_textXXX найден (объявлен строкой) */
    public function testFormMappingClassNotFoundExceptionOk02()
    {
        $this->expectNotToPerformAssertions();

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_textXXX',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        \IWA_FormBuilder\Entity\Service\MapModel::addItem('field_textXXX', '\IWA_FormBuilder\Entity\Model\Field\Text');

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** обычная полная форма */
    public function testOk01()
    {
        $this->expectNotToPerformAssertions();

        $source = new \IWA_FormBuilder\Entity([
            'entity'   => 'forms',
            'children' => [
                new \IWA_FormBuilder\Entity([
                    'entity'   => 'form',
                    'name'     => 'main',
                    'children' => [
                        new \IWA_FormBuilder\Entity([
                            'entity' => 'field_text',
                            'name'   => 'test1',
                            'label'  => 'текстовое поле 1',
                        ]),
                    ],
                ]),
            ],
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }

    /** обычная краткая форма */
    public function testOk02()
    {
        $this->expectNotToPerformAssertions();

        $source = new \IWA_FormBuilder\Entity([
            'entity' => 'field_text',
            'name'   => 'test1',
            'label'  => 'текстовое поле 1',
        ]);

        $form = new \IWA_FormBuilder\Form\Form();
        $form->parse('object', $source);
    }
}