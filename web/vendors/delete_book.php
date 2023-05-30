<?php

include "worker_route.php";

$referer = $_SERVER['HTTP_REFERER'] ?? null;

if (!isset($_GET['id'])) {
  if ($referer) {
    header("Location: $referer");
  } else {
    header("Location: /");
  }
}

include "connect.php";

$id = $_GET['id'];

$book = $db->query("SELECT * FROM `Product` WHERE `id` = '$id'")->fetch();

if (!$book) {
  if ($referer) {
    header("Location: $referer");
  } else {
    header("Location: /");
  }
}

$db->query("DELETE FROM `Product` WHERE `id` = '$id'");

if ($referer) {
  header("Location: $referer");
} else {
  header("Location: /");
}