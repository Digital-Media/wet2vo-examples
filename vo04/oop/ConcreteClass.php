<?php

require "AbstractClass.php";

/**
 * Concrete implementation of the abstract base class. The "missing" abstract method is implemented here.
 */
class ConcreteClass extends AbstractClass
{
    #[Override]
    protected function getValue(): string
    {
        return "ConcreteClass";
    }
}