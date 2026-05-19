<!DOCTYPE html>
<html lang="de">
<head>
    <title>Datei-Upload: Verzeichnisse</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" enctype="multipart/form-data" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <!-- MAX_FILE_SIZE ist nur ein Browser-Hint und kein Sicherheitsmerkmal -->
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type="file" name="userfiles[]" webkitdirectory multiple>
    <button type="submit">Hochladen</button>
</form>
<?php
require "upload_errors.php";

const UPLOAD_DIR = "uploads/";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nrOfFiles = count($_FILES["userfiles"]["name"]);
    for ($i = 0; $i < $nrOfFiles; $i++) {
        $error = $_FILES["userfiles"]["error"][$i];
        $relativePath = $_FILES["userfiles"]["full_path"][$i];
        $destination = UPLOAD_DIR . $relativePath;
        $safePath = htmlspecialchars($relativePath, ENT_QUOTES | ENT_HTML5);

        if ($error !== UPLOAD_ERR_OK) {
            $message = $uploadErrors[$error] ?? "Unbekannter Fehler (Code $error).";
            echo "<p>Fehler bei $safePath: $message</p>";
        } elseif (!is_dir(dirname($destination)) && !mkdir(dirname($destination), 0777, true)) {
            echo "<p>Fehler: Verzeichnis für $safePath konnte nicht erstellt werden.</p>";
        } elseif (move_uploaded_file($_FILES["userfiles"]["tmp_name"][$i], $destination)) {
            echo "<p>Upload von $safePath erfolgreich!</p>";
        } else {
            echo "<p>Fehler: $safePath konnte nicht gespeichert werden.</p>";
        }
    }
}
?>
</body>
</html>