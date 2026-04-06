<!DOCTYPE html>
<html lang="de">
<head>
    <title>GET-Formular</title>
    <meta charset="utf-8">
</head>
<body>
<form method="get" action="get.php">
    <label for="infolabel">Info:</label>
    <input type="text" name="info" id="infolabel">
    <button type="submit">Abschicken</button>
</form>

<?php
if (isset($_GET["info"])) {
    echo "<p>" . $_GET["info"] . "</p>";
}
?>
</body>
</html>
