<?php

include "auth_route.php";

if ($auth_token['role'] !== "ADMIN") {
  if (!$referer) {
    header("Location: /login.php");
  } else {
    header("Location: $referer");
  }
}