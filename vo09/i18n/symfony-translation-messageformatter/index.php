<?php

// Exclude deprecation notices (issues with symfony/translator and PHP 8.4)
error_reporting(E_ALL & ~E_DEPRECATED);

use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;

require "vendor/autoload.php";

$translator = new Translator("de-AT");
$translator->addLoader("yaml", new YamlFileLoader());
$translator->addResource("yaml", "translations/messages+intl-icu.en.yaml", "en-US", "messages+intl-icu");
$translator->addResource("yaml", "translations/messages+intl-icu.de.yaml", "de-AT", "messages+intl-icu");

echo "<p>{$translator->trans("party", [
        "host" => "Wolfgang",
        "gender_of_host" => "male",
        "guest" => "John Doe",
        "num_guests" => 3,
        "party_date" => new DateTime(),
    ])}</p>";