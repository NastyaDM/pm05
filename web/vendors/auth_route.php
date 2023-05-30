<?php

$auth_token = json_decode($_COOKIE['auth_token'] ?? "", true);
$referer = $_SERVER['HTTP_REFERER'] ?? null;

if (!$auth_token) {
  if (!$referer) {
    header("Location: /login.php");
  } else {
    header("Location: $referer");
  }
}

?>