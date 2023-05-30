<?php

unset($_COOKIE['auth_token']);
setcookie('auth_token', null, -1, '/');

header("Location: /login.php");

?>