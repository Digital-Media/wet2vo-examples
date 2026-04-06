<?php

namespace PHPUnitExample;

use Exception;
use InvalidArgumentException;

/**
 * Stores and prints a user's favorite subject of the Media Technology and Design program.
 * @package Hypermedia2\Vl11
 */
class FavoriteMTDSubject
{
    /**
     * The user's favorite MTD subject.
     * @var string
     */
    private(set) string $favoriteSubject;

    /**
     * FavoriteMTDSubject constructor.
     * @param string $favoriteSubject The favorite subject to store.
     * @throws InvalidArgumentException Thrown if the argument is an empty string.
     */
    public function __construct(string $favoriteSubject)
    {
        if (trim($favoriteSubject) === "") {
            throw new InvalidArgumentException("Favorite subject cannot be empty. You must choose!");
        }
        $this->favoriteSubject = $favoriteSubject;
    }

    /**
     * Returns the favorite MTD subject in a sentence.
     * @return string The best subject in MTD in a sentence.
     */
    public function say(): string
    {
        return "The best subject in MTD is " . $this->favoriteSubject . "!";
    }

    /**
     * Responds to a favorite subject statement.
     * @param string $input The other statement.
     * @return string The reply to the statement.
     * @throws Exception Thrown if not agreeing.
     */
    public function respondTo(string $input): string
    {
        $input = strtolower($input);
        $myFavoriteSubject = strtolower($this->favoriteSubject);

        if (mb_strpos($input, $myFavoriteSubject) === false) {
            throw new Exception(sprintf("Never! %s is the best subject in MTD!", $this->favoriteSubject));
        }

        return "Absolutely true!";
    }
}