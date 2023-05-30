<?php

$referer = $_SERVER['HTTP_REFERER'] ?? null;

if (!isset($_GET['id'])) {
  if ($referer) {
    header("Location: $referer");
  } else {
    header("Location: /");
  }
}

include "vendors/connect.php";
include_once "vendors/helpers.php";

$id = $_GET['id'];

$book = $db->query("SELECT * FROM `Product` WHERE `id` = '$id'")->fetch();

if (!$book) {
  if ($referer) {
    header("Location: $referer");
  } else {
    header("Location: /");
  }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/global.css" />
  <link rel="stylesheet" href="style/pages/product.css" />
  <title>BookHaven: Товар</title>
</head>

<body>
  <div class="wrapper">
    <?php include "partials/sidebar.php" ?>
    <div class="page-content">
      <?php include "partials/header.php" ?>
      <div class="page-content__wrapper">
        <section class="section w-auto">
          <div class="section-content">
            <div class="product-card">
              <div class="product-card-photo">
                <img src="assets/<?php echo $book['img'] ?>" alt="" />
              </div>
              <div class="product-card-info">
                <p class="product-card-info__title">
                  <?php echo $book['title'] ?>
                </p>
                <p class="product-card-info__author">
                  <?php echo $book['author'] ?>
                </p>
                <table>
                  <tr>
                    <td>Год издания</td>
                    <td>
                      <?php echo $book['year'] ?> год
                    </td>
                  </tr>
                  <tr>
                    <td>Издательство</td>
                    <td>
                      <?php echo $book['publish'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Количество страниц</td>
                    <td>
                      <?php echo $book['pages'] ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Тип обложки</td>
                    <td>
                      <?php echo mb_ucfirst(mb_strtolower($book['cover'])) ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Возрастные ограничения</td>
                    <td>
                      <?php echo $book['restrictions'] ?>+
                    </td>
                  </tr>
                </table>
                <div class="product-card-info__tags">
                  <?php

                  $tags = explode(",", $book['tags']);


                  foreach ($tags as $tag):
                    ?>
                    <span class="product-card-info_tag">
                      <?php echo $tag ?>
                    </span>
                  <?php endforeach ?>
                </div>
                <div class="product-card-info__footer">
                  <div class="product-card-info__price">
                    <span class="product-card-info__price text">Цена:&nbsp;</span>
                    <span class="product-card-info__price price">
                      <?php echo $book['price'] ?> ₽
                    </span>
                  </div>
                  <div class="product-card-info__actions">
                    <a href="product.phpdswdwddwdwd" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section w-auto">
          <header class="section-header">
            <h2 class="section-title medium">Описание</h2>
          </header>
          <div class="section-content">
            <div class="description">
              <?php echo $book['description'] ?>
            </div>
          </div>
        </section>
        <section class="section w-auto">
          <header class="section-header">
            <h2 class="section-title medium">Отзывы</h2>
          </header>
          <div class="section-content">
            <div class="description">
              <div class="description-header">
                <div class="description-header-info">
                  <div class="description-header-info-photo">
                    <img src="assets/profile.png" alt="" />
                  </div>
                  <div class="description-header-info-name">Виктория</div>
                  <div class="description-header-info-star">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#F3B514" />
                      <path
                        d="M12 4L14.1329 10.5643H21.035L15.4511 14.6213L17.584 21.1857L12 17.1287L6.41604 21.1857L8.54892 14.6213L2.96496 10.5643H9.86712L12 4Z"
                        fill="#F3B514" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#F3B514" />
                      <path
                        d="M12 4L14.1329 10.5643H21.035L15.4511 14.6213L17.584 21.1857L12 17.1287L6.41604 21.1857L8.54892 14.6213L2.96496 10.5643H9.86712L12 4Z"
                        fill="#F3B514" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#F3B514" />
                      <path
                        d="M12 4L14.1329 10.5643H21.035L15.4511 14.6213L17.584 21.1857L12 17.1287L6.41604 21.1857L8.54892 14.6213L2.96496 10.5643H9.86712L12 4Z"
                        fill="#F3B514" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#F3B514" />
                      <path
                        d="M12 4L14.1329 10.5643H21.035L15.4511 14.6213L17.584 21.1857L12 17.1287L6.41604 21.1857L8.54892 14.6213L2.96496 10.5643H9.86712L12 4Z"
                        fill="#F3B514" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#CECECE" />
                    </svg>
                  </div>
                </div>
                <div class="description-header-date">20.03.2023</div>
              </div>
              <div class="description-info">
                <div class="description-info text">
                  <p class="description-info-title">
                    Старая сказка на новый лад
                  </p>
                  <p class="description-info-text">
                    Красивое издание. История Дракулы как бы, но под другим углом, от лица других персонажей.
                  </p>
                </div>
                <div class="description-info text">
                  <p class="description-info-title plus">
                    Плюсы
                  </p>
                  <p class="description-info-text">
                    Было интересно читать
                  </p>
                </div>
                <div class="description-info text">
                  <p class="description-info-title minus">
                    Минусы
                  </p>
                  <p class="description-info-text">
                    Не всем понравится, учитывая жанр и поднятые в романе темы
                  </p>
                </div>
              </div>
            </div>
            <div class="description">
              <div class="description-header">
                <div class="description-header-info">
                  <div class="description-header-info-photo">
                    <img src="assets/profile.png" alt="" />
                  </div>
                  <div class="description-header-info-name">Ольга</div>
                  <div class="description-header-info-star">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#F3B514" />
                      <path
                        d="M12 4L14.1329 10.5643H21.035L15.4511 14.6213L17.584 21.1857L12 17.1287L6.41604 21.1857L8.54892 14.6213L2.96496 10.5643H9.86712L12 4Z"
                        fill="#F3B514" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#CECECE" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#CECECE" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#CECECE" />
                    </svg>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M8.075 18.875L12 16.525L15.925 18.9L14.875 14.45L18.325 11.45L13.775 11.05L12 6.85L10.225 11.025L5.675 11.425L9.125 14.425L8.075 18.875ZM5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z"
                        fill="#CECECE" />
                    </svg>
                  </div>
                </div>
                <div class="description-header-date">20.03.2023</div>
              </div>
              <div class="description-info">
                <div class="description-info text">
                  <p class="description-info-title">
                    Просто ужас, тихий ужас
                  </p>
                  <p class="description-info-text">
                    Окей прочла я пару страниц и захотела сжечь книгу, обложка- 10/10, текст - 2/10 тк очень сильно
                    смахивает на фанфик с Мэри Сью.Сюжет, как и мысли героини, несётся со скоростью гепарда, вот они
                    только в одном месте и уже в другом с другими действиями. 300 страниц наполненных разочарованием и
                    героиней которая НИКАК , совершенно никак не пытается развиваться по сюжету книги.
                  </p>
                </div>
                <div class="description-info text">
                  <p class="description-info-title plus">
                    Плюсы
                  </p>
                  <p class="description-info-text">
                    Обложка
                  </p>
                </div>
                <div class="description-info text">
                  <p class="description-info-title minus">
                    Минусы
                  </p>
                  <p class="description-info-text">
                    Героиня словно кусок бревна текущего по реке жизни, а другие персонажи особо то и не описаны. Можно
                    было растянуть эту книгу по сюжету, добавив детали, размышления героини и прочие моменты в которых
                    читатель бы стал к ней ближе, но они растянули его на 300 страниц уже другими способами...
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section">
          <header class="section-header">
            <h2 class="section-title">Похожее</h2>
            <a href="catalog.phpdswdwddwdwd" class="button">Посмотреть все</a>
          </header>
          <div class="section-content">
            <div class="product-list">
              <div class="product">
                <a href="product.phpdswdwddwdwd" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.phpdswdwddwdwd" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product">
                <a href="product.phpdswdwddwdwd" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.phpdswdwddwdwd" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product">
                <a href="product.phpdswdwddwdwd" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.phpdswdwddwdwd" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product">
                <a href="product.phpdswdwddwdwd" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.phpdswdwddwdwd" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>