<?php

require "vendor/autoload.php";

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

$config = new HtmlSanitizerConfig()->allowSafeElements();
$sanitizer = new HtmlSanitizer($config);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Formularübertragung sicher mit symfony/html-sanitizer</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <label for="datenlabel">Eingabe:</label>
    <input type="text" name="daten" id="datenlabel">
    <button type="submit">Abschicken</button>
</form>
<ul>
    <li>Ungefährliches HTML wird generell erlaubt.</li>
    <li>Schädliches HTML (&lt;script&gt;-Tags, Event-Handler etc.) wird
        entfernt.
    </li>
    <li>Fehlerhaftes HTML wird korrigiert.</li>
</ul>
<?php
if (isset($_POST["daten"])) {
    $datenBereinigt = $sanitizer->sanitize($_POST["daten"]);
    echo "<div>$datenBereinigt</div>";
}
?>
</body>
</html>