<?php

use IWA_FormBuilder\Tools\InheritAttributeManager\Main;
use PHPUnit\Framework\TestCase;

class InheritAttributeManagerTest extends TestCase
{
    /** нет внешних данных. перый вызов parse попадет в результат */
    public function testOK01()
    {
        $attributes = [];

        Main::parseAttributeString($attributes, 'test1_1', 'text1');
        Main::parseAttributeString($attributes, 'test1_1', 'text2');
        Main::parseAttributeString($attributes, 'test1_1', null);
        $this->assertEquals($attributes['test1_1'], 'text1', 'test1_1');

        Main::parseAttributeString($attributes, 'test1_2', '');
        Main::parseAttributeString($attributes, 'test1_2', 'text2');
        Main::parseAttributeString($attributes, 'test1_2', 'text3');
        $this->assertEquals($attributes['test1_2'], '', 'test1_2');

        /////////////////////////////////////////////////////////////////////////////

        Main::parseAttributeBoolean($attributes, 'test2_1', true);
        Main::parseAttributeBoolean($attributes, 'test2_1', false);
        Main::parseAttributeBoolean($attributes, 'test2_1', null);
        $this->assertEquals($attributes['test2_1'], true, 'test2_1');

        Main::parseAttributeBoolean($attributes, 'test2_2', false);
        Main::parseAttributeBoolean($attributes, 'test2_2', true);
        Main::parseAttributeBoolean($attributes, 'test2_2', null);
        $this->assertEquals($attributes['test2_2'], false, 'test2_2');

        /////////////////////////////////////////////////////////////////////////////

        Main::parseAttributeInteger($attributes, 'test3_1', 5);
        Main::parseAttributeInteger($attributes, 'test3_1', 10);
        Main::parseAttributeInteger($attributes, 'test3_1', null);
        $this->assertEquals($attributes['test3_1'], 5, 'test3_1');

        Main::parseAttributeInteger($attributes, 'test3_2', 0);
        Main::parseAttributeInteger($attributes, 'test3_2', 5);
        Main::parseAttributeInteger($attributes, 'test3_2', 10);
        $this->assertEquals($attributes['test3_2'], 0, 'test3_2');

    }

    /** нет внешних данных. первый вызов parse = null, второй вызов parse попадет в результат */
    public function testOK02()
    {
        $attributes = [];

        Main::parseAttributeString($attributes, 'test1', null);
        Main::parseAttributeString($attributes, 'test1', 'text2');
        Main::parseAttributeString($attributes, 'test1', 'text3');
        $this->assertEquals($attributes['test1'], 'text2', 'test1');

        Main::parseAttributeBoolean($attributes, 'test2', null);
        Main::parseAttributeBoolean($attributes, 'test2', true);
        Main::parseAttributeBoolean($attributes, 'test2', false);
        $this->assertEquals($attributes['test2'], true, 'test2');

        Main::parseAttributeInteger($attributes, 'test3', null);
        Main::parseAttributeInteger($attributes, 'test3', 5);
        Main::parseAttributeInteger($attributes, 'test3', 10);
        $this->assertEquals($attributes['test3'], 5, 'test3');
    }

    /** внешние данные. вызов parse не попадет в результат */
    public function testOK03()
    {
        $attributes = [];

        $attributes['test1_1'] = '';
        Main::parseAttributeString($attributes, 'test1_1', 'text2');
        $this->assertEquals($attributes['test1_1'], '', 'test1_1');

        $attributes['test1_2'] = 'text1';
        Main::parseAttributeString($attributes, 'test1_2', 'text2');
        $this->assertEquals($attributes['test1_2'], 'text1', 'test1_2');

        /////////////////////////////////////////////////////////////////////////////

        $attributes['test2_1'] = true;
        Main::parseAttributeBoolean($attributes, 'test2_1', false);
        $this->assertEquals($attributes['test2_1'], true, 'test2_1');

        $attributes['test2_2'] = 'true';
        Main::parseAttributeBoolean($attributes, 'test2_2', false);
        $this->assertEquals($attributes['test2_2'], true, 'test2_2');

        $attributes['test2_3'] = 'yes';
        Main::parseAttributeBoolean($attributes, 'test2_3', false);
        $this->assertEquals($attributes['test2_3'], true, 'test2_3');

        $attributes['test2_4'] = '1';
        Main::parseAttributeBoolean($attributes, 'test2_4', false);
        $this->assertEquals($attributes['test2_4'], true, 'test2_4');

        $attributes['test2_5'] = 1;
        Main::parseAttributeBoolean($attributes, 'test2_5', false);
        $this->assertEquals($attributes['test2_5'], true, 'test2_5');

        /////////////////////////////////////////////////////////////////////////////

        $attributes['test3_1'] = false;
        Main::parseAttributeBoolean($attributes, 'test3_1', true);
        $this->assertEquals($attributes['test3_1'], false, 'test3_1');

        $attributes['test3_2'] = 'false';
        Main::parseAttributeBoolean($attributes, 'test3_2', true);
        $this->assertEquals($attributes['test3_2'], false, 'test3_2');

        $attributes['test3_3'] = 'no';
        Main::parseAttributeBoolean($attributes, 'test3_3', true);
        $this->assertEquals($attributes['test3_3'], false, 'test3_3');

        $attributes['test3_4'] = '0';
        Main::parseAttributeBoolean($attributes, 'test3_4', true);
        $this->assertEquals($attributes['test3_4'], false, 'test3_4');

        $attributes['test3_5'] = 0;
        Main::parseAttributeBoolean($attributes, 'test3_5', true);
        $this->assertEquals($attributes['test3_5'], false, 'test3_5');

        /////////////////////////////////////////////////////////////////////////////

        $attributes['test4_1'] = 5;
        Main::parseAttributeInteger($attributes, 'test4_1', 10);
        $this->assertEquals($attributes['test4_1'], 5, 'test4_1');

        $attributes['test4_2'] = '5';
        Main::parseAttributeInteger($attributes, 'test4_2', 10);
        $this->assertEquals($attributes['test4_2'], 5, 'test4_2');

        $attributes['test4_3'] = 5.5;
        Main::parseAttributeInteger($attributes, 'test4_3', 10);
        $this->assertEquals($attributes['test4_3'], 5, 'test4_3');

        $attributes['test4_4'] = '5px';
        Main::parseAttributeInteger($attributes, 'test4_4', 10);
        $this->assertEquals($attributes['test4_4'], 5, 'test4_4');
    }

    /** тестирование ошибки */
    public function testCheckAttributeExceptionFail01()
    {
        $this->expectException(\IWA_FormBuilder\Tools\InheritAttributeManager\CheckAttributeException::class);

        $attributes = [];

        Main::getAttributeString($attributes, 'test1');
    }
    
    /** тестирование ошибки */
    public function testCheckAttributeExceptionFail02()
    {
        $this->expectException(\IWA_FormBuilder\Tools\InheritAttributeManager\CheckAttributeException::class);

        $attributes = [];

        Main::getAttributeBoolean($attributes, 'test1');
    }
    
    /** тестирование ошибки */
    public function testCheckAttributeExceptionFail03()
    {
        $this->expectException(\IWA_FormBuilder\Tools\InheritAttributeManager\CheckAttributeException::class);

        $attributes = [];

        Main::getAttributeInteger($attributes, 'test1');
    }

    /** тестирование отсутствия ошибки */
    public function testCheckAttributeExceptionOk01()
    {
        $this->expectNotToPerformAssertions();

        $attributes = [];

        Main::getAttributeString($attributes, 'test1', '');
    }
    
    /** тестирование отсутствия ошибки */
    public function testCheckAttributeExceptionOk02()
    {
        $this->expectNotToPerformAssertions();

        $attributes = [];

        Main::getAttributeBoolean($attributes, 'test1', false);
    }
    
    /** тестирование отсутствия ошибки */
    public function testCheckAttributeExceptionOk03()
    {
        $this->expectNotToPerformAssertions();

        $attributes = [];

        Main::getAttributeInteger($attributes, 'test1', 0);
    }
}