<?php

/**
 * Final classes cannot be inherited from.
 */
final class NoInheritance
{
    public function foo(): void
    {
        // ...
    }
}

/**
 * Class with final method and constant. This method and this constant cannot be overridden in a derived class.
 */
class CantOverrideEverything
{
    public const int CAN_OVERRIDE = 1;
    final public const int CANNOT_OVERRIDE = 2;

    public function canOverride(): void
    {
        // ...
    }

    final public function cantOverride(): void
    {
        // ...
    }
}

/**
 * This class inherits from CantOverrideEverything and can only override canOverride() and the constant CAN_OVERRIDE.
 */
class InheritParts extends CantOverrideEverything
{
    public const int CAN_OVERRIDE = 3;

    public function canOverride(): void
    {
        // ...
    }
}
