<?php

namespace LoginExample;

use Fhooe\Router\Router;
use PDO;
use Random\RandomException;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * This class enables users to log in to the system with a provided username and password. Both items are matched with
 * stored credentials. If they match, a login hash is stored in the session that acts as a token for a successful login.
 * Other pages can then use check for this token before the site is initialized and perform a redirect to prevent
 * accessing the page
 * @package LoginExample
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2025
 */
final class Login
{
    /**
     * @var PDO The PDO object for database access.
     */
    private PDO $pdo;

    /**
     * @var array<string, string> This array is used to store error and status messages
     * after a form was sent and validated.
     */
    private array $messages = [];

    /**
     * @var Environment Provides a Twig object to display HTML templates.
     */
    private Environment $twig;

    /**
     * @var Router The Router object for redirecting the user to the main page after a successful login.
     */
    private Router $router;

    /**
     * Creates a new Login object. It takes a Twig Environment object used to display a response (output).
     * The constructor needs to initialize the database for reading and updating user information.
     * @param Environment $twig The Twig object for displaying a response.
     * @param Router $router The Router object for redirecting the user to the main page after a successful login.
     */
    public function __construct(Environment $twig, Router $router)
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->initDB();
    }

    /**
     * Initializes the database connection. Connects to the database "login_example".
     * @return void Returns nothing.
     */
    private function initDB(): void
    {
        $host = "db";
        $port = 3306;
        $database = "login_example";
        $dsn = "mysql:host=$host;port=$port;dbname=$database";
        $username = "hypermedia";
        $password = "geheim";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->pdo = new PDO($dsn, $username, $password, $options);
    }

    /**
     * Validates the user input. If errors are detected, they are stored in the messages array.
     * If no errors are found, the method business() is invoked which continues the login process and forwards the
     * logged-in user to the protected content.
     * @return void Returns nothing.
     * @throws RandomException Thrown when the login token cannot be generated.
     */
    public function isValid(): void
    {
        if (Utilities::isEmptyString($_POST["email"])) {
            $this->messages["email"] = "Please enter your email address.";
        } elseif (!Utilities::isEmail($_POST["email"])) {
            $this->messages["email"] = "Please enter a valid email address";
        }
        if (Utilities::isEmptyString($_POST["password"])) {
            $this->messages["password"] = "Please enter your password.";
        }

        if (count($this->messages) === 0) {
            if (!$this->authenticateUser()) {
                $this->messages["login"] = "Invalid account email address or password.";
            } else {
                $this->business();
            }
        }
    }

    /**
     * This method is only called when the form input was validated successfully.
     * It stores the e-mail address in the session for further use (e.g., in the template) and a login token to identify
     * a successful login.
     * It then forwards to the protected main page.
     * @return void Returns nothing.
     * @throws RandomException Thrown when the login token cannot be generated.
     */
    protected function business(): void
    {
        $_SESSION["email"] = $_POST["email"];

        $_SESSION["loginToken"] = Utilities::generateLoginToken();

        $this->router->redirectTo("/main");
    }

    /**
     * Authenticates a user by matching the entered e-mail address (username) and password with the stored records.
     * If the username is present and the entered password matches the stored password, a valid login is assumed and
     * stored in $_SESSION. After a successful login, the current password encryption is checked, and if necessary, a
     * rehash is performed and the updated password is stored in the database.
     * @return bool Returns true if the combination of username and password is valid, otherwise false.
     */
    private function authenticateUser(): bool
    {
        $query = "SELECT user_id, email, password FROM user WHERE email = :email";
        $params = [":email" => $_POST["email"]];

        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        $row = $statement->fetch();

        if ($row && password_verify($_POST["password"], $row["password"])) {
            if (password_needs_rehash($row["password"], PASSWORD_DEFAULT)) {
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $this->updateUser($row["user_id"], $password);
            }
            return true;
        }
        return false;
    }

    /**
     * Replaces a user's password with a new one if an outdated hashing algorithm has been detected.
     * @param string $userID The user ID.
     * @param string $password The new password.
     * @return void Returns nothing.
     */
    private function updateUser(string $userID, string $password): void
    {
        $query = "UPDATE user SET password = :password WHERE user_id = :user_id";
        $params = [':password' => $password, ':user_id' => $userID];
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
    }

    /**
     * Renders the login form and displays it.
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function displayOutput(): void
    {
        $this->twig->display("login.html.twig", [
            "email" => $_POST["email"],
            "messages" => $this->messages,
        ]);
    }
}