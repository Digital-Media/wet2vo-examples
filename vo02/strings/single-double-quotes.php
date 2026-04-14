<?php

// Einfache Anführungszeichen (keine Ersetzung)
echo 'Hallo' . '<br>'; // Hallo
echo 'Hallo\nWelt' . '<br>'; // Hallo\nWelt
echo 'Wichtig: $text' . '<br>'; // Wichtig: $text
echo 'PHP ist \'toll\'' . '<br><br>'; // PHP ist 'toll'

// Doppelte Anführungszeichen (Interpolation)
echo "Hallo" . "<br>"; // Hallo
echo "Hallo\nWelt" . "<br>"; // Hallo
                             // Welt
$text = "Variable wurde interpoliert!";
echo "Wichtig: $text" . "<br>"; // Wichtig: Variable wurde interpoliert!
echo "PHP ist \"toll\"" . "<br>"; // PHP ist "toll"
// curly syntax
$count = 3;
echo "Dauer: $countmin"; // Dauer: 3min