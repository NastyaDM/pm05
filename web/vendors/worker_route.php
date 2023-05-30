<?php

include "auth_route.php";

$role = $auth_token['role'];

if ($role === "USER") {
  header("Location: /login.php");
}