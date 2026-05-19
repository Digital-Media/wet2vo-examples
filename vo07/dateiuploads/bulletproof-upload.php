<?php

// Für allgemeine Uploads (beliebige Dateitypen): symfony/http-foundation (UploadedFile)
require "vendor/autoload.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Datei-Uploads mit samayo/bulletproof</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" enctype="multipart/form-data"
      action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type="file" name="userfile">
    <button type="submit">Hochladen</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $image = new Bulletproof\Image($_FILES);
    $image
        ->setStorage("uploads/")
        ->setMime(["jpeg", "png", "gif"])
        ->setSize(1, 2 * 1024 * 1024);

    if ($image["userfile"]) {
        $upload = $image->upload();

        if ($upload) {
            echo "<p>Upload von {$upload->getName()} erfolgreich!</p>";
        } else {
            echo "<p>Fehler: {$image->getError()}</p>";
        }
    } else {
        echo "<p>Fehler: {$image->getError()}</p>";
    }
}
?>
</body>
</html>