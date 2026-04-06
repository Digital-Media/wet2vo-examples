<!DOCTYPE html>
<html lang="de">
<head>
    <title>Datei-Upload: Einzelne Datei</title>
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
    if ($_FILES["userfile"]["error"] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES["userfile"]["tmp_name"], $_FILES["userfile"]["name"]);
        echo "<p>Upload von " . $_FILES["userfile"]["name"] . " erfolgreich!</p>";
    } else {
        echo "<p>Ein Fehler ist aufgetreten: " . $_FILES["userfile"]["error"] . "</p>";
        // Fehlercode analysieren und entsprechende Fehlermeldungen ausgeben
    }
}
?>
</body>
</html>