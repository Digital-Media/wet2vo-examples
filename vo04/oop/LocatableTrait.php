<?php

/**
 * Trait with methods to store and output position data (latitude and longitude).
 */
trait LocatableTrait
{
    /**
     * @var float|null The latitude of the position.
     */
    public ?float $latitude = null;
    /**
     * @var float|null The longitude of the position.
     */
    public ?float $longitude = null;

    /**
     * Returns the stored position as a coordinate pair.
     * @return array The array with latitude (Pos. 0) and longitude (Pos. 1).
     */
    public function getPosition(): array
    {
        return [$this->latitude, $this->longitude];
    }

    /**
     * Sets a coordinate pair from latitude and longitude.
     * @param array $pos The array with latitude (Pos. 0) and longitude (Pos. 1).
     * @return void Returns nothing.
     */
    public function setPosition(array $pos): void
    {
        $this->latitude = $pos[0];
        $this->longitude = $pos[1];
    }
}