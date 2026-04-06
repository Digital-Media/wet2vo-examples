<?php

require "vendor/autoload.php";

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Formularübertragung sicher mit HTML Purifier</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <label for="datenlabel">Eingabe:</label>
    <input type="text" name="daten" id="datenlabel">
    <button type="submit">Abschicken</button>
</form>
<ul>
    <li>HTML wird generell erlaubt.</li>
    <li>Schädliches HTML (&lt;script&gt;-Tags) wird gefiltert.</li>
    <li>Fehlerhaftes HTML wird korrigiert.</li>
</ul>
<?php
if (isset($_POST["daten"])) {
    $datenBereinigt = $purifier->purify($_POST["daten"]);
    echo "<div>" . $datenBereinigt . "</div>";
}
?>
</body>
</html>