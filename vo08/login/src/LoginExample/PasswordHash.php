<?php

namespace LoginExample;

use Latte\Engine;

/**
 * This class allows users to generate a hash for a given password and algorithm using PHP's password_hash function.
 * @package LoginExample
 * @author  Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2026
 */
class PasswordHash
{
    /**
     * @var Engine Provides a Latte object to display HTML templates.
     */
    private Engine $latte;

    /**
     * @var string The password to be hashed.
     */
    private string $password;

    /**
     * @var string The hash generated from the password.
     */
    private string $hash;

    /**
     * Creates a new PasswordHash object. It takes a Latte Engine object used to display a response (output).
     * If the user has submitted a password and an algorithm, the hash is generated.
     *
     * @param Engine $latte The Latte object for displaying a response.
     */
    public function __construct(Engine $latte)
    {
        $this->latte = $latte;
        $this->password = "";
        $this->hash = "";

        if (isset($_POST["password"]) && isset($_POST["algo"])) {
            $this->generateHash();
        }
    }

    /**
     * Generates a hash for the password using the selected algorithm.
     *
     * @return void Returns nothing.
     */
    private function generateHash(): void
    {
        $this->password = $_POST["password"];
        $this->hash = password_hash($this->password, $_POST["algo"]);
    }

    /**
     * Renders the output using Latte.
     */
    public function displayOutput(): void
    {
        // Get all algorithms supported by this PHP build (e.g. '2y', 'argon2i', 'argon2id').
        $supportedAlgos = password_algos();

        // Filter all defined PHP constants to those whose name starts with PASSWORD_ and whose
        // value is a supported algorithm identifier. ARRAY_FILTER_USE_BOTH passes (value, key)
        // to the callback, so the closure parameters must be in that order.
        $algoConstants = array_filter(
            get_defined_constants(),
            fn(mixed $value, string $name) => str_starts_with($name, 'PASSWORD_') && in_array(
                    $value,
                    $supportedAlgos,
                    true,
                ),
            ARRAY_FILTER_USE_BOTH,
        );

        $this->latte->render("passwordhash.latte", [
            "algos" => $algoConstants,
            "password" => $this->password,
            "hash" => $this->hash,
        ]);
    }
}