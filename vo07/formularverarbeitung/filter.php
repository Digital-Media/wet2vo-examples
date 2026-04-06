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
    echo "<section>" . PHP_EOL;
    echo "unfiltered (EVIL!): <div>$text</div><br>" . PHP_EOL;
    echo "htmlspecialchars(): <div>" . htmlspecialchars(
            $text,
            ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
        ) . "</div><br>" . PHP_EOL;
    echo "htmlentities(): <div>" . htmlentities(
            $text,
            ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5,
        ) . "</div><br>" . PHP_EOL;
    echo "filter_var(): <div>" . filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "</div><br>" . PHP_EOL;
    echo "filter_input(): <div>" . filter_input(
            INPUT_GET,
            "eingabe",
            FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        ) . "</div><br>" . PHP_EOL;
    echo "strip_tags(): <div>" . strip_tags($text) . "</div>" . PHP_EOL;
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