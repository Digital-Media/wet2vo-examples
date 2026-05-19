<!DOCTYPE html>
<html lang="de">
<head>
    <title>Datei-Upload: Einzelne Datei</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" enctype="multipart/form-data"
      action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <!-- MAX_FILE_SIZE ist nur ein Browser-Hint und kein Sicherheitsmerkmal -->
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type="file" name="userfile">
    <button type="submit">Hochladen</button>
</form>
<?php
require "upload_errors.php";

const UPLOAD_DIR = "uploads/";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $error = $_FILES["userfile"]["error"];

    if ($error !== UPLOAD_ERR_OK) {
        $message = $uploadErrors[$error] ?? "Unbekannter Fehler (Code $error).";
        echo "<p>Fehler: $message</p>";
    } else {
        $originalName = basename($_FILES["userfile"]["name"]);
        if (move_uploaded_file(
            $_FILES["userfile"]["tmp_name"],
            UPLOAD_DIR . $originalName,
        )
        ) {
            echo "<p>Upload von " . htmlspecialchars(
                    $originalName,
                    ENT_QUOTES | ENT_HTML5,
                ) . " erfolgreich!</p>";
        } else {
            echo "<p>Fehler: Datei konnte nicht gespeichert werden.</p>";
        }
    }
}
?>
</body>
</html>