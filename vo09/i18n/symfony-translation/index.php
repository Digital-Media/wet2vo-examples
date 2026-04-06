<?php

// Exclude deprecation notices (issues with symfony/translator and PHP 8.4)
error_reporting(E_ALL & ~E_DEPRECATED);

use Symfony\Component\Translation\Loader\JsonFileLoader;
use Symfony\Component\Translation\Translator;

require "vendor/autoload.php";

$locale = "en-US";
if (isset($_GET["locale"])) {
    $locale = $_GET["locale"];
}

$translator = new Translator($locale);
$translator->addLoader("json", new JsonFileLoader());
$translator->addResource("json", "translations/messages.de.json", "de-AT");
$translator->addResource("json", "translations/messages.en.json", "en-US");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>i18n with symfony/translation</title>
</head>
<body>
<form method="get" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <label for="language"><?= $translator->trans("selectLabel") ?></label><br>
    <select name="locale" id="language">
        <option value="en-US"><?= $translator->trans("optionLabel") ?></option>
        <option value="en-US">English</option>
        <option value="de-AT">Deutsch</option>
    </select><br>
    <label for="messages"><?= $translator->trans("messageLabel") ?></label><br>
    <input type="number" id="messages" name="nrOfMessages"><br>
    <button type="submit"><?= $translator->trans("sendButton") ?></button>
</form>
<?php

echo "<p>{$translator->trans("welcome")}</p>";

if (isset($_GET["nrOfMessages"])) {
    $nrOfMessages = $_GET["nrOfMessages"];

    echo match ($nrOfMessages) {
        "0" => $translator->trans("messages.zero"),
        "1" => $translator->trans("messages.one"),
        default => $translator->trans("messages.other", ["%d" => $nrOfMessages])
    };
}
?>
</body>
</html>