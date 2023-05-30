<?php

$db_name = "book_haven";
$db_user = "root";
$db_pass = "";

try {
  $db = new PDO('mysql:host=localhost;dbname=' . $db_name, $db_user, $db_pass);
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>