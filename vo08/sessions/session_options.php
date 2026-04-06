<?php

session_start(["cookie_lifetime" => 3600]);
// session_start(); // Kann alternativ einkommentiert werden - ergibt 0 bei der Lifetime
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Session mit Optionen</title>
    <meta charset="utf-8">
</head>
<body>
<?php
$params = session_get_cookie_params();
echo "<p>Cookie Lifetime: {$params["lifetime"]}</p>";
?>
</body>
</html>