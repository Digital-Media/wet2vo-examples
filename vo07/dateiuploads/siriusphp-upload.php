<?php

// Exclude deprecation notices (issues with siriusphp/upload and PHP 8.4)
error_reporting(E_ALL & ~E_DEPRECATED);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Datei-Uploads mit siriusphp/upload</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" enctype="multipart/form-data" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type="file" name="userfile">
    <button type="submit">Hochladen</button>
</form>
<?php
// Wenn Formular abgeschickt
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require "vendor/autoload.php";

    $uploadHandler = new \Sirius\Upload\Handler(".");

    $uploadHandler->addRule("extension", ["allowed" => ["jpg", "gif", "png"]], "Nur JPG, GIF und PNG sind erlaubt.");
    $uploadHandler->addRule("size", ["size" => "2M"], "Die Datei darf maximal 2MB groß sein.");

    $result = $uploadHandler->process($_FILES["userfile"]);

    if ($result->isValid()) {
        echo "<p>Upload von " . $result->name . " erfolgreich!</p>";
        $result->confirm();
    } else {
        echo "<ul>";
        foreach ($result->getMessages() as $message) {
            echo "<li>$message</li>";
        }
        echo "</ul>";
    }
}