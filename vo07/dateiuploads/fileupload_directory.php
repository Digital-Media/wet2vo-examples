<!DOCTYPE html>
<html lang="de">
<head>
    <title>Datei-Upload: Verzeichnisse</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" enctype="multipart/form-data" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
    <input type="file" name="userfiles[]" webkitdirectory multiple>
    <button type="submit">Hochladen</button>
</form>
<?php
// Wenn Formular abgeschickt
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nrOfFiles = count($_FILES["userfiles"]["name"]);
    for ($i = 0; $i < $nrOfFiles; $i++) {
        if ($_FILES["userfiles"]["error"][$i] === UPLOAD_ERR_OK) {
            // Verzeichnispfad extrahieren
            $directoryPath = dirname($_FILES["userfiles"]["full_path"][$i]);

            // Überprüfen, ob das Verzeichnis bereits existiert
            if (!is_dir($directoryPath)) {
                // Wenn nicht, Verzeichnis rekursiv erstellen
                if (!mkdir($directoryPath, 0777, true)) {
                    echo "<p>Fehler beim Erstellen des Verzeichnisses für " . htmlspecialchars(
                            $_FILES["userfiles"]["full_path"][$i]
                        ) . "</p>";
                    continue; // Abbruch, falls ein Fehler passiert ist
                }
            }

            move_uploaded_file($_FILES["userfiles"]["tmp_name"][$i], $_FILES["userfiles"]["full_path"][$i]);
            echo "<p>Upload von " . $_FILES["userfiles"]["full_path"][$i] . " erfolgreich!</p>";
        } else {
            echo "<p>Ein Fehler ist beim Upload von " . $_FILES["userfiles"]["full_path"][$i] . " aufgetreten: " . $_FILES["userfiles"]["error"][$i] . "</p>";
            // Fehlercode analysieren und entsprechende Fehlermeldungen ausgeben
        }
    }
}
?>
</body>
</html>