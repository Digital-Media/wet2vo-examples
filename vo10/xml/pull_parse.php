<?php

require "XMLExample/MyPullParser.php";

use XMLExample\MyPullParser;

$xmlParser = new MyPullParser();
$xmlParser->parse("rezept.xml");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>XML-Pull-Parser</title>
    <meta charset="utf-8">
</head>
<body>
<h1><?= $xmlParser->dish ?></h1>
<p>Quelle: <a href="<?= $xmlParser->source ?>"><?= $xmlParser->source ?></a></p>
<h2>Zutaten</h2>
<ul>
    <?php
    foreach ($xmlParser->ingredients as $ingredient) {
        echo "<li>" . $ingredient["menge"] . " " . $ingredient["einheit"] . " " . $ingredient["ingredienz"] . "</li>";
    }
    ?>
</ul>
<h2>Zubereitung</h2>
<ol>
    <?php
    foreach ($xmlParser->steps as $step) {
        echo "<li>$step</li>";
    }
    ?>
</ol>
</body>
</html>