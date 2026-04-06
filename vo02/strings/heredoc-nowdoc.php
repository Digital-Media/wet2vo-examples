<?php
$name = "John Doe";
$hdText = <<<EOT
<p class="bold">Dies ist
ein Text von $name, der
genau so durch die
Zeilenumbrüche im String
gespeichert wird.</p>
EOT;

$ndText = <<<'EOT'
<p class="bold">Dies ist
ein Text von $name,
der genau so durch die
Zeilenumbrüche im String
gespeichert wird.</p>
EOT;

// Anmerkung: nl2br() ist eine PHP-Funktion, die Zeilenumbrüche (\n) in <br>-Elemente umwandelt.
echo nl2br($hdText);

echo nl2br($ndText);
