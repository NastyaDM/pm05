<?php

include "../vendors/worker_route.php";
include "../vendors/connect.php";
include_once "../vendors/helpers.php";

$referer = $_SERVER['HTTP_REFERER'] ?? null;
$id = $_GET['id'];

$book = $db->query("SELECT * FROM `Product` WHERE `id` = '$id'")->fetch();

if (!$book) {
  if ($referer) {
    header("Location: $referer");
  } else {
    header("Location: /");
  }
}




$response_message = null;

function handle_post($db, $id)
{
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

  ['errors' => $errors, 'upload_file_name' => $upload_file_name] = save_file($img, "../assets/");

  if ($errors) {
    return $errors;
  }

  $db->query("UPDATE `Product` SET `title` = '$title', `author` = '$author', `year` = '$year', `publish` = '$publish', `pages` = '$pages', `cover` = '$cover', `restrictions` = '$restrictions', `price` = '$price', `tags` = '$tags', `description` = '$description', `img` = '$upload_file_name' WHERE `id` = '$id'");

  return "Данные успешно изменены!";
}

if (isset($_POST['submit'])) {
  $response = $response_message = handle_post($db, $id);
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style/global.css" />
  <link rel="stylesheet" href="../style/pages/edit.css" />
  <script src="../js/input-file.js" defer></script>
  <title>BookHaven: Редактирование</title>
</head>

<body>
  <div class="wrapper">
    <?php include "../partials/sidebar.php" ?>
    <div class="page-content">
      <?php include "../partials/header.php" ?>
      <div class="page-content__wrapper">
        <section class="section w-auto">
          <header class="section-header">
            <h2 class="section-title">Редактирование книги</h2>
          </header>
          <div class="section-content">
            <form action="edit.php?id=<?php echo $book['id'] ?>" method="POST" class="form"
              enctype="multipart/form-data">
              <div class="form-inputs">
                <div class="form-input">
                  <input type="text" value="<?php echo $book['title'] ?>" placeholder="Название" name="title"
                    required />
                </div>
                <div class="form-input">
                  <input type="text" value="<?php echo $book['author'] ?>" placeholder="Автор" name="author" required />
                </div>
                <div class="form-input">
                  <input type="number" value="<?php echo $book['year'] ?>" placeholder="Год издания" required
                    name="year" />
                </div>
                <div class="form-input">
                  <input type="text" value="<?php echo $book['publish'] ?>" placeholder="Издательство" name="publish"
                    required />
                </div>
                <div class="form-input">
                  <input type="number" value="<?php echo $book['pages'] ?>" placeholder="Количество страниц"
                    name="pages" required />
                </div>
                <div class="form-input">
                  <input type="text" value="<?php echo mb_ucfirst(mb_strtolower($book['cover'])) ?>"
                    placeholder="Тип обложки" name="cover" required />
                </div>
                <div class="form-input">
                  <input type="number" value="<?php echo $book['restrictions'] ?>" placeholder="Возрастные ограничения"
                    name="restrictions" required />
                </div>
                <div class="form-input">
                  <input type="text" value="<?php echo $book['tags'] ?>" placeholder="Тэги" name="tags" />
                </div>
                <div class="form-input">
                  <input type="number" value="<?php echo $book['price'] ?>" placeholder="Цена" name="price" required />
                </div>
                <div class="form-input description">
                  <textarea placeholder="Описание" name="description"
                    required><?php echo $book['description'] ?></textarea>
                </div>
                <div class="form-input file">
                  <input type="file" required name="img" id="img" accept="image/jpeg, image/jpg, image/png, image/webp"
                    data-input-file="file-r" />
                  <label for="img">
                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.25 19V12.75H5V11.25H11.25V5H12.75V11.25H19V12.75H12.75V19H11.25Z" fill="black" />
                      </svg>
                    </span>
                    <span id="file-r" class="file-result">
                      Выбрано фото:
                      <?php echo $book['img'] ?>
                    </span>
                  </label>
                </div>
              </div>
              <?php if ($response_message): ?>
                <p class="form-response">
                  <?php echo $response_message ?>
                </p>
              <?php endif ?>
              <div class="form-actions">
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? "/" ?>" class="button">Отмена</a>
                <input value="Изменить" class="button filled" type="submit" name="submit">
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>