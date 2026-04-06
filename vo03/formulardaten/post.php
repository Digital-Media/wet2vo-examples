<!DOCTYPE html>
<html lang="de">
<head>
    <title>POST-Formular</title>
    <meta charset="utf-8">
</head>
<body>
<form method="post" action="post.php">
    <label for="infolabel">Info:</label>
    <input type="text" name="info" id="infolabel">
    <button type="submit">Abschicken</button>
</form>

<?php
if (isset($_POST["info"])) {
    echo "<p>" . $_POST["info"] . "</p>";
}
?>
</body>
</html>
