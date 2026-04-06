<?php

require "GeometricComponentInterface.php";

/**
 * Generic implementation of a Rectangle with upper left and lower right corner and a color.
 * Classic version without property promotion and property hooks.
 */
class RectangleClassic implements GeometricComponentInterface
{
    public static string $version = "1.0.0";
    public const string TYPE = "RectangleClassic";
    public int $x1 = 0;
    public int $y1 = 0;
    public int $x2 = 0;
    public int $y2 = 0;
    public private(set) string $color = "white";

    /**
     * Creates a new rectangle.
     * @param int $id The ID of this very rectangle.
     * @param int $x1 The x-coordinate of the upper left corner.
     * @param int $y1 The y-coordinate of the upper left corner.
     * @param int $x2 The x-coordinate of the lower right corner.
     * @param int $y2 The y-coordinate of the lower right corner.
     * @param string $color The rectangle's color.
     */
    public function __construct(
        public readonly int $id,
        int $x1 = 0,
        int $y1 = 0,
        int $x2 = 0,
        int $y2 = 0,
        string $color = "white",
    ) {
        $this->color = $color;
        $this->y2 = $y2;
        $this->x2 = $x2;
        $this->y1 = $y1;
        $this->x1 = $x1;
    }

    /**
     * Called, when the rectangle is destroyed.
     */
    public function __destruct()
    {
        echo "Destructor called!";
    }

    /**
     * Moves the rectangle by $dx and $dy units.
     * @param int $dx The distance moved on the x-axis.
     * @param int $dy The distance moved on the y-axis.
     */
    public function move(int $dx, int $dy): void
    {
        $this->x1 += $dx;
        $this->y1 += $dy;
        $this->x2 += $dx;
        $this->y2 += $dy;
    }

    /**
     * Returns the upper left x-position.
     * @return int The upper left x-position.@return int
     */
    public function getX1(): int
    {
        return $this->x1;
    }

    /**
     * Returns this class' version.
     * @return string The version information.
     */
    public function getVersion(): string
    {
        return self::$version;
    }

    /**
     * Prints this class' version information.
     */
    public static function printVersion(): void
    {
        echo self::$version;
    }

    /**
     * Returns this class' type information.
     * @return string The class type as a string.
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * Draws this rectangle.
     */
    public function draw(): void
    {
        // ...
    }
}

$green = "green";

// Create a new rectangle with default values
$rect1 = new Rectangle(1);
$rect2 = new Rectangle(2, 45, 60, 110, 112, $green);
$rect1->move(10, 10);

// Output the static variable
echo RectangleClassic::$version; // 1.0.0
echo $rect1->getVersion(); // 1.0.0
//echo $rect1->version; // NOTICE & WARNING!

// Call static methods
RectangleClassic::printVersion(); // 1.0.0
$rect1->printVersion(); // Works, but not necessary/recommended

// Print out constants
echo RectangleClassic::TYPE; // RectangleClassic
echo $rect1->getType(); // RectangleClassic
//echo $rect1->TYPE; // FEHLER!

// Trying to change a read-only property ($id) will cause an error
//$rect1->id = 3; // ERROR!
