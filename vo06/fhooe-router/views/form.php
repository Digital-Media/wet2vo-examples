<?php

global $router;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Page</title>
</head>
<body>
<h1>Form</h1>
<p>This is the form page!</p>

<form action="<?= $router->urlFor("/form") ?>" method="post">
    <label for="message">Message:</label>
    <input type="text" name="msg" id="message">
    <button type="submit">Send Message</button>
</form>

<?php
if (isset($_POST["msg"])) {
    echo "<p>Message: " . $_POST["msg"] . "</p>";
}
?>

<p>Why not also try the <a href="<?= $router->urlFor("/") ?>">main page</a>?</p>
</body>
</html>