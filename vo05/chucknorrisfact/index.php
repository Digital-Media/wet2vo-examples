<?php

require "vendor/autoload.php";

$client = new GuzzleHttp\Client();

$categoriesResponse = $client->request(
    "GET",
    "https://api.chucknorris.io/jokes/categories",
);

$categoriesBody = $categoriesResponse->getBody();
$categories = json_decode($categoriesBody);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Random Chuck Norris Fact</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>Get a Random Chuck Norris Fact</h1>
<form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="post">
    <label for="categorySelector">Select a category for a fact:</label>
    <select name="category" id="categorySelector">
        <?php
        foreach ($categories as $category) {
            echo "<option value=\"$category\">$category</option>";
        }
        ?>
    </select>
    <button type="submit">Roundhouse!</button>
</form>

<?php
if (isset($_POST["category"])) {
    echo "<h2>Random fact from category " . $_POST["category"] . "</h2>";

    $factResponse = $client->request(
        "GET",
        "https://api.chucknorris.io/jokes/random",
        [
            "query" => [
                "category" => $_POST["category"],
            ],
        ],
    );

    $factBody = $factResponse->getBody();
    $fact = json_decode($factBody);
    echo "<p>" . $fact->value . "</p>";
}
?>
</body>
</html>
