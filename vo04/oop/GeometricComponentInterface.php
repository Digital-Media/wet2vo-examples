<?php

/**
 * Defines a geometric component that can be drawn and moved.
 */
interface GeometricComponentInterface
{
    /**
     * Moves the geometric component by $dx and $dy units.
     * @param int $dx The distance moved on the x-axis.
     * @param int $dy The distance moved on the y-axis.
     */
    public function move(int $dx, int $dy): void;

    /**
     * Draws the geometric component.
     */
    public function draw(): void;
}
