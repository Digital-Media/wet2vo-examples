<?php

session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Session-Counter</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (!isset($_SESSION["counter"])) {
    $_SESSION["counter"] = 0;
} else {
    $_SESSION["counter"]++;
}

echo "<p>Anzahl Reloads: {$_SESSION["counter"]}</p>";
echo '<p><a href="session_counter.php">Seite neu laden</a></p>';
echo '<p><a href="session_destroy.php">Session löschen</a></p>';
?>
</body>
</html>