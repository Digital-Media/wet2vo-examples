<?php

require "XMLExample/MyDOMParser.php";

use XMLExample\MyDOMParser;

$xmlParser = new MyDOMParser();
$xmlParser->parse("rezept.xml");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>DOM-Parser</title>
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