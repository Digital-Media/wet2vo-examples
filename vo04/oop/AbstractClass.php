<?php

/**
 * Abstract base class. The function printOut() is implemented, getValue() is not. A child class must do this.
 */
abstract class AbstractClass
{
    abstract protected function getValue(): string;

    public function printOut(): void
    {
        echo $this->getValue();
    }
}
