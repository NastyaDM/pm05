<?php

function format_data(string $data): string
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  return $data;
}

function mb_ucfirst($text)
{
  return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}

function save_file($img, $path = 'assets/')
{

  $img_tmp_name = $img['tmp_name'];

  $img_size = getimagesize($img_tmp_name);

  if (!$img_size) {

    return ["errors" => "Ошибка загрузки файла!", "upload_file_name" => null];
  }

  $upload_dir = $path;
  $upload_file_name = time() . "_" . basename($img['name']);

  $target_upload = $upload_dir . $upload_file_name;

  if (!move_uploaded_file($img_tmp_name, $target_upload)) {
    return ["errors" => "Ошибка загрузки файла", "upload_file_name" => null];
  }

  return ["upload_file_name" => $upload_file_name, "errors" => null];
}