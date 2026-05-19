<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Filter-Funktionen</title>
    <style>
        section {
            border: 2px solid black;
            padding: 2px;
            margin-bottom: 10px;
        }

        section div {
            display: inline-block;
            background-color: orange;
        }
    </style>
</head>
<body>
<?php
if (isset($_GET["eingabe"])) {
    $text = $_GET["eingabe"];
    $results = [
        "unfiltered (EVIL!)" => $text,
        "htmlspecialchars()" => htmlspecialchars(
            $text,
            ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
        ),
        "htmlentities()"     => htmlentities(
            $text,
            ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
        ),
        "filter_var()"       => filter_var(
            $text,
            FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        ),
        "filter_input()"     => filter_input(
            INPUT_GET,
            "eingabe",
            FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        ),
        "strip_tags()"       => strip_tags($text),
    ];

    echo "<section>" . PHP_EOL;
    foreach ($results as $label => $value) {
        echo "$label: <div>$value</div><br>" . PHP_EOL;
    }
    echo "</section>" . PHP_EOL;
}
?>
<form action="<?= $_SERVER["SCRIPT_NAME"] ?>" method="get">
    <label for="eingabe">String:</label>
    <input id="eingabe" name="eingabe" type="text">
    <button type="submit">Überprüfen</button>
</form>
</body>
</html>