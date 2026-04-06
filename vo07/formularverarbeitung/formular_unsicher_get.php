<!DOCTYPE html>
<html lang="de">
<head>
    <title>Formularübertragung unsicher mit GET</title>
    <meta charset="utf-8">
</head>
<body>

<form method="get" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <label for="datenlabel">Eingabe:</label>
    <input type="text" name="daten" id="datenlabel" size="50">
    <button type="submit">Abschicken</button>
</form>

<!-- Eingabe von <script>alert("XSS Alarm!")</script> triggert XSS -->

<?php
if (isset($_GET["daten"])) {
    echo "<p>" . $_GET["daten"] . "</p>";
}
?>
</body>
</html>