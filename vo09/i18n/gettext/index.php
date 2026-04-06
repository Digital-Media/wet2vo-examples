<?php

$locale = "en_US.utf8";
if (isset($_GET["locale"])) {
    $locale = $_GET["locale"];
}

putenv("LANGUAGE=$locale");
putenv("LANG=$locale");
setlocale(LC_ALL, $locale);
$domain = "messages";
bindtextdomain($domain, __DIR__ . "/locale");
textdomain($domain);
bind_textdomain_codeset($domain, "UTF-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>i18n with Gettext</title>
</head>
<body>
<form method="get" action="<?= $_SERVER["SCRIPT_NAME"] ?>">
    <label for="language"><?= _("Please select the language.") ?></label><br>
    <select name="locale" id="language">
        <option value="en_US.utf8"><?= _("Select language") ?></option>
        <option value="en_US.utf8">English</option>
        <option value="de_AT.utf8">Deutsch</option>
    </select><br>
    <label for="messages"><?= _("Please select the number of messages.") ?></label><br>
    <input type="number" id="messages" name="nrOfMessages"><br>
    <button type="submit"><?= _("Send") ?></button>
</form>
<?php

echo "<p>" . _("Welcome to the site!") . "</p>";

if (isset($_GET["nrOfMessages"])) {
    $nrOfMessages = intval($_GET["nrOfMessages"]);

    echo sprintf(ngettext("You have %d message.", "You have %d messages.", $nrOfMessages), $nrOfMessages);
}

clearstatcache();
?>
</body>
</html>