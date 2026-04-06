<?php

global $router;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
</head>
<body>
<h1>Main</h1>
<p>This is the main page!</p>

<p>Why not also try the <a href="<?= $router->urlFor("/form") ?>">form</a>?</p>
</body>
</html>