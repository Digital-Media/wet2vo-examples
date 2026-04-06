<!DOCTYPE html>
<html lang="de">
<head>
    <title>Datei-Upload: Mehrere Dateien</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" enctype="multipart/form-data" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type="file" name="userfiles[]" multiple>
    <button type="submit">Hochladen</button>
</form>
<?php
// Wenn Formular abgeschickt
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nrOfFiles = count($_FILES["userfiles"]["name"]);
    for ($i = 0; $i < $nrOfFiles; $i++) {
        if ($_FILES["userfiles"]["error"][$i] === UPLOAD_ERR_OK) {
            move_uploaded_file($_FILES["userfiles"]["tmp_name"][$i], $_FILES["userfiles"]["name"][$i]);
            echo "<p>Upload von " . $_FILES["userfiles"]["name"][$i] . " erfolgreich!</p>";
        } else {
            echo "<p>Ein Fehler ist beim Upload von " . $_FILES["userfiles"]["name"][$i] . " aufgetreten: " . $_FILES["userfiles"]["error"][$i] . "</p>";
            // Fehlercode analysieren und entsprechende Fehlermeldungen ausgeben
        }
    }
}
?>
</body>
</html>