<?php

namespace RestApiExample;

use PDO;

/**
 * A simple REST API example for listing and creating users.
 * @package RestApiExample
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2025
 */
class UserManager
{
    /**
     * @var PDO The PDO object.
     */
    private PDO $pdo;

    /**
     * @var string Defines the content type that this class unterstands.
     */
    private string $contentType;

    /**
     * @var string The URL for user endpoints. This is used for generating links in the JSON output.
     */
    private string $link = "/users";

    /**
     * Creates a new user manager that lists and creates stored users.
     */
    public function __construct()
    {
        $this->initDB();
        $this->contentType = "application/json";
    }

    /**
     * Initializes the database connection. Connects to the database "rest_api_example".
     * @return void Returns nothing.
     */
    private function initDB(): void
    {
        $host = "db";
        $port = 3306;
        $database = "rest_api_example";
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
     * Returns a JSON representation of all the stored users in a system.
     * @return void Returns nothing because it generates JSON output.
     */
    public function listUsers(): void
    {
        $query = "SELECT * FROM rest_api_example.user";

        $statement = $this->pdo->query($query);
        $users = $statement->fetchAll();

        $jsonResponse = [
            "size" => count($users),
            "link" => $this->link,
        ];

        foreach ($users as $user) {
            $newUser = $user;
            $newUser["link"] = "$this->link/{$user["id"]}";
            $jsonResponse["users"][] = $newUser;
        }

        // Show the successful response. Even if 0 users are in the system, there's an output.
        $this->showResponse(200, $jsonResponse);
    }

    /**
     * Lists a single user with a given ID and returns a JSON representation.
     * @param int|string $id The ID of the desired user. Can be an integer or a string that is numeric.
     * @return void Returns nothing because it generates JSON output.
     */
    public function listUser(int|string $id): void
    {
        if (is_string($id) && !is_numeric($id)) {
            // If the ID is not a number, return a 400 Bad Request response.
            $this->showResponse(400, ["error" => "The given ID has to be a number"]);
            return;
        }

        $query = "SELECT * FROM rest_api_example.user WHERE id = :id";

        // Select and retrieve this one user.
        $statement = $this->pdo->prepare($query);
        $params = [":id" => $id];
        $statement->execute($params);
        $users = $statement->fetchAll();

        // If there's exactly one user that has been retrieved, generate output. Otherwise, generate a 404 response.
        if (count($users) === 1) {
            $jsonResponse = $users[0];
            $jsonResponse["link"] = "$this->link/$id";
            $this->showResponse(200, $jsonResponse);
        } else {
            $this->showResponse(404, ["error" => "No entry with ID $id found"]);
        }
    }

    /**
     * Add a new user to the system.
     * @return void Returns nothing because it generates JSON output.
     */
    public function addUser(): void
    {
        $query = "INSERT into rest_api_example.user SET username = :username, realname = :realname";

        $statement = $this->pdo->prepare($query);
        $params = [":username" => $_POST["username"], ":realname" => $_POST["realname"]];
        $success = $statement->execute($params);

        // If adding the user was successful, show 201 otherwise error 500 because something internally went wrong.
        if ($success) {
            // This could also return the entry of the new user here if necessary
            $this->showResponse(201, [
                "message" => "User successfully created",
                "link" => "$this->link/{$this->pdo->lastInsertId()}",
            ]);
        } else {
            $this->showResponse(500, ["error" => "An error occurred while creating the user"]);
        }
    }

    /**
     * Generates a response with a given status code and, if provided, with the necessary content. The content has to be
     * provided as an associative array and is transformed into the data format here. This example stays with JSON, but
     * there could be other formats as well.
     * @param int $statusCode The HTTP/REST status code to be returned.
     * @param array|null $content The content that is transformed into the desired output format.
     * @return void Returns nothing because it generates JSON output.
     */
    private function showResponse(int $statusCode, ?array $content = null): void
    {
        // If the request's Accept header contains our content type
        if (str_contains($_SERVER["HTTP_ACCEPT"], $this->contentType)) {
            http_response_code($statusCode);
            header("Content-Type: " . $this->contentType);
            if (isset($content)) {
                echo json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(406);
        }
    }
}