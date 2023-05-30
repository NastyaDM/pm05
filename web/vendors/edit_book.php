<?php


$referer = $_SERVER['HTTP_REFERER'] ?? null;

if (!isset($_GET['id'])) {
  if ($referer) {
    header("Location: $referer");
  } else {
    header("Location: /");
  }
}

include "connect.php";
include_once "helpers.php";

$id = $_GET['id'];

$book = $db->query("SELECT * FROM `Product` WHERE `id` = '$id'")->fetch();

if (!$book) {
  if ($referer) {
    header("Location: $referer");
  } else {
    header("Location: /");
  }
}

$title = format_data($_POST['title']);
$author = format_data($_POST['author']);
$year = format_data($_POST['year']);
$publish = format_data($_POST['publish']);
$pages = format_data($_POST['pages']);
$cover = strtoupper(format_data($_POST['cover']));
$restrictions = format_data($_POST['restrictions']);
$price = format_data($_POST['price']);
$tags = format_data($_POST['tags']);
$description = format_data($_POST['description']);
$img = $_FILES['img'];
$query = "UPDATE `Product` SET `title` = '$title', `author` = '$author', `year` = '$year', `publish` = '$publish', `pages` = '$pages', `cover` = '$cover', `restrictions` = '$restrictions', `price` = '$price', `tags` = '$tags', `description` = '$description'";

['errors' => $errors, 'upload_file_name' => $upload_file_name] = save_file($img, "../assets/");

if ($errors) {
  echo $errors;
  die;
}

$db->query("UPDATE `Product` SET `title` = '$title', `author` = '$author', `year` = '$year', `publish` = '$publish', `pages` = '$pages', `cover` = '$cover', `restrictions` = '$restrictions', `price` = '$price', `tags` = '$tags', `description` = '$description', `img` = '$upload_file_name' WHERE `id` = '$id'");

echo "Данные успешно изменены!";