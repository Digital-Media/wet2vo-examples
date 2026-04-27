<?php

require "Rectangle.php";

/**
 * Implementation of a 3D box based on a 2D rectangle.
 */
class Box extends Rectangle
{
    public int $depth;

    /**
     * Draws this box.
     */
    #[Override]
    public function draw(): void
    {
        // Draw the front (Rectangle)
        parent::draw();
        // Draw the other sides
        // ...
    }
}