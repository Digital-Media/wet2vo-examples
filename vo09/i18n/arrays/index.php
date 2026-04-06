<?php

$locale = "en";
if (isset($_GET["locale"])) {
    $locale = $_GET["locale"];
}

require __DIR__ . "/locale/$locale.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>i18n with simple Arrays</title>
</head>
<body>
<form method="get" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <label for="language"><?= $messages["selectLabel"] ?></label><br>
    <select name="locale" id="language">
        <option value="en"><?= $messages["optionLabel"] ?></option>
        <option value="en">English</option>
        <option value="de">Deutsch</option>
    </select><br>
    <label for="messages"><?= $messages["messageLabel"] ?></label><br>
    <input type="number" id="messages" name="nrOfMessages"><br>
    <button type="submit"><?= $messages["sendButton"] ?></button>
</form>
<?php
echo "<p>{$messages["welcome"]}</p>";

if (isset($_GET["nrOfMessages"])) {
    $nrOfMessages = $_GET["nrOfMessages"];

    echo match ($nrOfMessages) {
        "0" => $messages["messages"]["zero"],
        "1" => $messages["messages"]["one"],
        default => sprintf($messages["messages"]["other"], $nrOfMessages),
    };
}
?>
</body>
</html>