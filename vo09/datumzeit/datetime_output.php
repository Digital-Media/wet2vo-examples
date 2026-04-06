<?php

// Zeitzone setzen, falls am Server eine andere (z.B. UTC)
date_default_timezone_set("Europe/Vienna");

/* Aktuelle Uhrzeit */
$d = new DateTime();
echo "<p>It's now " . $d->format("r") . "</p>";
echo "<p>It's now " . $d->format("d.m.Y, H:i:s e") . "</p>";