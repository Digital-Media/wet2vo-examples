<!DOCTYPE html>
<html lang="de">
<head>
    <title>Formularübertragung unsicher mit POST</title>
    <meta charset="utf-8">
</head>
<body>

<form method="post" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <label for="datenlabel">Eingabe:</label>
    <input type="text" name="daten" id="datenlabel" size="50">
    <button type="submit">Abschicken</button>
</form>

<!-- Eingabe von <script>alert("XSS Alarm!")</script> triggert XSS -->

<?php
if (isset($_POST["daten"])) {
    echo "<p>" . $_POST["daten"] . "</p>";
}
?>
</body>
</html>