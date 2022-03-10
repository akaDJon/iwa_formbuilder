<?php

class Foo
{
    private string $bar = 'bar';

    public function getBar(): string
    {
        return $this->bar;
    }
}

$a = new Foo();
/** @11psalm-11suppress UnusedMethodCall */
$a->getBar();
