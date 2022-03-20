<?php

//https://github.com/vimeo/psalm/issues/7807

class Test
{
    public const TYPE_CLASS = 'class';
    public const TYPE_STYLE = 'style';
    public const TYPE_ATTR  = 'attr';

    public function show(string $type): void
    {
        $array = [
            static::TYPE_CLASS => 'my class',
            static::TYPE_STYLE => 'my style',
            static::TYPE_ATTR  => 'my attr',
        ];

        echo $array[$type];
    }
}

$test = new Test();

$test->show(Test::TYPE_CLASS);

