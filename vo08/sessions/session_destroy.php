<?php

session_start();

$_SESSION = [];

if (isset($_COOKIE[session_name()])) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        "",
        [
            "expires" => time() - 42000,
            "path" => $params["path"],
            "domain" => $params["domain"],
            "secure" => $params["secure"],
            "httponly" => $params["httponly"],
            "samesite" => $params["samesite"],
        ],
    );
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Session-Counter</title>
    <meta charset="utf-8">
</head>
<body>
<p>Session gelöscht!</p>
<a href="session_counter.php">Neuer Counter</a>
</body>
</html>