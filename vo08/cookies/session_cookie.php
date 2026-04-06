<?php

if (!isset($_COOKIE["user"])) {
    setcookie("user", "John Doe");
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Cookies</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (!isset($_COOKIE["user"])) {
    echo "<p>Cookie nicht vorhanden. Setze neues Cookie&nbsp;…</p>";
} else {
    echo "<p>Cookie vorhanden. Lese aus&nbsp;…</p>";
    echo "<p>User*innenname: {$_COOKIE["user"]}</p>";
}
?>
</body>
</html>