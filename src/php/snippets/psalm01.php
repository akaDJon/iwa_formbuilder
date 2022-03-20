<?php

//https://github.com/vimeo/psalm/issues/7797

require_once('./../../vendor/autoload.php');

abstract class Core
{
    protected string $message;

    public function __construct()
    {
        $this->message = '"__construct"';
    }

    public static function getInstance(): static
    {
        /** @psalm-suppress UnsafeInstantiation */
        $self = new static();

        $self->message = $self->message . ' and "hi from Core"';

        return $self;
    }
}

class Child1 extends Core
{
    /** @111psalm-suppress MoreSpecificReturnType */
    public static function getInstance(): static
    {
        $self = parent::getInstance();

        $self->message = $self->message . ' and "hi from Child"';

        /** @111psalm-suppress LessSpecificReturnStatement */
        return $self;
    }
}

class Child2 extends Core
{
}

dump(new Child1());

dump((new Child1())->getInstance());

dump(new Child2());

dump((new Child2())->getInstance());
