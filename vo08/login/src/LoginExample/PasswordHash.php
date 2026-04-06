<?php

namespace LoginExample;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * This class allows users to generate a hash for a given password and algorithm using PHP's password_hash function.
 * @package LoginExample
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2025
 */
class PasswordHash
{
    /**
     * @var Environment Provides a Twig object to display HTML templates.
     */
    private Environment $twig;

    /**
     * @var string The password to be hashed.
     */
    private string $password;

    /**
     * @var string The hash generated from the password.
     */
    private string $hash;

    /**
     * Creates a new PasswordHash object. It takes a Twig Environment object that is used to display a response
     * (output).
     * If the user has submitted a password and an algorithm, the hash is generated.
     * @param Environment $twig The Twig object for displaying a response.
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
        $this->password = "";
        $this->hash = "";

        if (isset($_POST["password"]) && isset($_POST["algo"])) {
            $this->generateHash();
        }
    }

    /**
     * Generates a hash for the password using the selected algorithm.
     * @return void Returns nothing.
     */
    private function generateHash(): void
    {
        $this->password = $_POST["password"];
        $this->hash = password_hash($this->password, $_POST["algo"]);
    }

    /**
     * Renders the output using Twig.
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function displayOutput(): void
    {
        $this->twig->display("passwordhash.html.twig", [
            "default" => PASSWORD_DEFAULT,
            "bcrypt" => PASSWORD_BCRYPT,
            "argon2i" => PASSWORD_ARGON2I,
            "argon2id" => PASSWORD_ARGON2ID,
            "password" => $this->password,
            "hash" => $this->hash,
        ]);
    }
}